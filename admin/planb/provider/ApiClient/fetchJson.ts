const sanitize = (path: string): string => {
  const prefixes = ['/api/', '/']

  prefixes.forEach((prefix: string) => {
    if (path.startsWith(prefix)) {
      path = path.slice(prefix.length)
    }
  })

  return path
}

const fetchJson = async (
  baseUrl: URL,
  path: string,
  options: RequestInit = {},
) => {
  const url = `${baseUrl}/${sanitize(path)}`

  const response = await fetch(url, {
    ...options,
    // cache: "force-cache",
    next: { revalidate: 3 },
  })

  if (response.status === 204) {
    return {}
  }

  const json = await response.json()
  if (!response.ok) {
    return Promise.reject(json)
  }

  return json
}

export default fetchJson
