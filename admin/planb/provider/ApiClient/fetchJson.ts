const sanitize = (path: string): string => {
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
  const rest = await fetch(url, options)
  return await rest.json()
}

export default fetchJson
