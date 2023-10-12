import * as process from "process";
import {ApiClientMode} from "./apiClient";

const serverUrl: string = (process.env.NEXT_PUBLIC_SERVER_NAME as string) || 'http://localhost'

const modes = {
  ProxyMode: new URL('/admin/api', serverUrl),
  ClientMode: new URL('/api', serverUrl),
  ServerMode: new URL('http://php/api')
}

export function ApiUrl(mode: ApiClientMode, relative?: string): URL {
  const base = modes[mode]
  return relative
    ? new URL(`${base}/${relative}`)
    : base
}
