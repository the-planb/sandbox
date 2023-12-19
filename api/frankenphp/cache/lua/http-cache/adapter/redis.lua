local redis = require "resty.redis"
local json = require('rapidjson')

Redis = {}

Redis.new = function(options)
  self = {}
  local host = options['host'] or 'redis'
  local port = options['port'] or 6379

  local red = redis.new()

  red:set_timeouts(1000, 1000, 1000)
  red:set_keepalive(1000, 20)
  red:connect(host, port)

  function get_cache_tags(res)

    local cacheTags = res.header['Xkey'] or ''
    local cacheTags = res.header['Xkey'] or ''
    return string.gmatch(cacheTags, "([^,]+)")
  end

  function get_maxage(res)
    local cacheControl = res.header['Cache-Control'] or ''
    local age = string.match(cacheControl, 's-maxage=(%d+)')
    return tonumber(age) or 0
  end

  function get_age(res, ttl)
    local maxAge = tonumber(res['max-age'] or -1)
    local ttl = tonumber(ttl or -1)
    if (maxAge <= 0 or ttl <= 0 ) then
      return null
    end

    return maxAge - ttl
  end

  function purge_tag(tag)
    local keys = red:smembers(tag)

    for _, key in pairs(keys) do
      red:del(key)
    end
    red:del(tag)

    return keys
  end

  -- ok, res|err
  function self:get(key)
    local res, err = red:get(key)

    red:init_pipeline()
    red:get(key)
    red:ttl(key)
    local results, err = red:commit_pipeline()

    if not results then
        return false, err
    end

    local res = results[1]
    local ttl = results[2]

    if res == ngx.null then return true, nil end

    local res = json.decode(res)
    local age = get_age(res, ttl)
    res.header['Age'] = age

    return true, res
  end

  -- ok, res|err
  function self:set(key, res)
    local maxage = get_maxage(res)
    res['max-age'] = maxage

    if maxage <= 0 then
      return true, res
    end

    red:init_pipeline()
    red:set(key, json.encode(res))
    red:expire(key, maxage)

    for tag in get_cache_tags(res) do
      red:sadd('tag:'..tag, key)
    end

    local ok, err = red:commit_pipeline()

    if not ok then
        return false, err
    end

    return true, res
  end

  function self:purge(header)
    local xkeys = string.gmatch(header, "([^,]+)")
    local all = {}
    for tag in xkeys do
      purge_tag('tag:'..tag)
    end
    return true
  end

  return self
end

return Redis

