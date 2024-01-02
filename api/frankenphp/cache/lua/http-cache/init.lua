require 'http-cache/method'
require 'http-cache/adapter/redis'
local json = require('rapidjson')
local md5 = require('md5')
local jwt = require('resty.jwt')

local function jwt_token_to_hash(ngx)
--  local token = ngx.req.get_headers()['authorization']
  local token = ngx.var.cookie_token


  if not token then
    return true, ''
  end

  token = token:gsub('^Bearer ', '') .. '='
  local obj = jwt:load_jwt(token)
  if not obj['valid'] then
    return false, nil
  end

  local hash = ''
  local roles = (obj['payload'] or {})['roles']
  if roles then
    table.sort(roles)
    hash = md5.sumhexa(json.encode('roles'))
  end

  return true, hash

end

local function get_key(ngx)
  local ok, hash = jwt_token_to_hash(ngx)
  if not ok then return false, nil end

  if ngx.var.query_string then
    return true, 'key:'..hash..ngx.var.request_uri.."?"..ngx.var.query_string
  end

  return true, 'key:'..hash..ngx.var.request_uri
end

CacheProxy = {}

CacheProxy.new = function(ngx, options)
  local self = {}
  local ngx = ngx

  local location = options['location'] or '/backend'

  local cache = Redis.new(options['redis'] or {
        host=  "redis",
        port= 6379
  })

  function handle()
    if(ngx.var.request_method == 'PURGE') then
      return do_purge()
    end

    if(ngx.var.request_method == 'GET') then
      return do_get()
    end

    return do_pass()
  end

  function do_purge()

    local header = ngx.req.get_headers()['xkey'] or ''
    ok = cache:purge(header)
    if not ok then
      return do_error('Something went wrong when Purge: ' .. header)
    end

    return {body = 'PURGE: ' .. header, status = 200}, 'PASS'
  end

  function do_get()
    local ok, key = get_key(ngx)
    if not ok then
      local fresh, _ = do_pass()
      return fresh, 'PASS'
    end

    ok, res = cache:get(key)
    if (not ok) then return do_error(res) end

    if (res) then
      return res, 'HIT'
    end

    local fresh, _ = do_pass()
    if(fresh.status >= 200 and  fresh.status < 300) then
      local ok, res = cache:set(key, fresh)
      if (not ok) then return do_error(res) end
      return fresh, 'MISS'
    end

    return fresh, 'PASS'
  end

  function do_pass()
    local method = method_to_constant(ngx.var.request_method)

    ngx.req.read_body()
    local res = ngx.location.capture(location, {
       method = method,
       always_forward_body = true,
       copy_all_vars = true
     });

    return res, 'PASS'
  end

  function do_error(body)

    return {status= 500, body= body}, 'ERROR'
  end

  function finalize(res, status)
    for name, header in pairs(res.header or {}) do
      ngx.header[name] = header
    end

    ngx.header['X-CACHE'] = status

    ngx.status = res.status
    ngx.say(res.body)
    ngx.exit(res.status)
  end

  return {
   resolve = function()
      res, status = handle()

      finalize(res, status)
   end
  }

end

return CacheProxy
