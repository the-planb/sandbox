function method_to_constant(method)

  local table = {
    GET = ngx.HTTP_GET,
    HEAD = ngx.HTTP_HEAD,
    PUT = ngx.HTTP_PUT,
    POST = ngx.HTTP_POST,
    DELETE = ngx.HTTP_DELETE,
    OPTIONS = ngx.HTTP_OPTIONS,
    MKCOL = ngx.HTTP_MKCOL,
    COPY = ngx.HTTP_COPY,
    MOVE = ngx.HTTP_MOVE,
    PROPFIND = ngx.HTTP_PROPFIND,
    PROPPATCH = ngx.HTTP_PROPPATCH,
    LOCK = ngx.HTTP_LOCK,
    UNLOCK = ngx.HTTP_UNLOCK,
    PATCH = ngx.HTTP_PATCH,
    TRACE = ngx.HTTP_TRACE,
  }

  return table[method]

--  local map = {
--    GET = ngx.HTTP_GET,
--    POST = ngx.HTTP_POST,
--    PUT = ngx.HTTP_PUT,
--  }
--
--  return map[mehod]
end

return method_to_constant
