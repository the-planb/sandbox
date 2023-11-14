import {NextRequest, NextResponse} from "next/server";
import {ApiUrl} from "@planb/provider";
import fetchJson from "@planb/provider/ApiClient/fetchJson";
import {IriComposer} from "@planb/provider/ApiClient/iriComposer";
import {headers} from "next/headers";


export async function GET(request: NextRequest) {
  const base = ApiUrl("ServerMode")
  const url = new URL(request.url)

  const Preload = request.headers.get('X-Preload') ?
    {Preload: request.headers.get('X-Preload')} :
    {}

  const options: RequestInit = {
    headers: {
      ...request.headers,
      Authorization: `Bearer ${request.cookies.get('token')?.value}`,
      ...Preload
    },
    body: null
  }

  const data = await fetchJson(base, `${url.pathname}${url.search}`, options)
  const complete = await IriComposer({
    data,
    headers: options.headers
  })

  return NextResponse.json(complete)
}
