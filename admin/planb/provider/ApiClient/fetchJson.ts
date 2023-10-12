const sanitize = (path: String): String => {
  const prefixes = ['/api/', '/']

  prefixes.forEach((prefix: string) => {

    if (path.startsWith(prefix)) {
      path = path.slice(prefix.length);
    }
  })

  return path
}


const fetchJson = async (baseUrl: URL, path: string, options: RequestInit = {}) => {

  const url = `${baseUrl}/${sanitize(path)}`
  const response = await fetch(url, options)

  if (response.status === 204) {
    return {}
  }
  return await response.json()
}

export default fetchJson
