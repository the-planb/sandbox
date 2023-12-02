import { type NextRequest, NextResponse } from 'next/server'
import { ApiUrl } from '@planb/provider'
import fetchJson from '@planb/provider/ApiClient/fetchJson'
import { IriComposer } from '@planb/provider/ApiClient/iriComposer'

export async function GET(request: NextRequest) {
  const base = ApiUrl('ServerMode')
  const url = new URL(request.url)


  const Preload = request.headers.get('X-Preload')
    ? { Preload: request.headers.get('X-Preload') }
    : {}

  const options: RequestInit = {
    headers: {
      ...request.headers,
      'Content-Type': 'application/ld+json',
      Authorization: `Bearer ${request.cookies.get('token')?.value}`,
      ...Preload,
    },
    body: null,
  }

  return await fetchJson(base, `${url.pathname}${url.search}`, options)
    .then(async (data) => {
      const complete = await IriComposer({
        data: data as object,
        headers: options.headers,
      })
      return NextResponse.json(complete)
    })
    .catch((error) => {
      return NextResponse.json(error, {
        status: 500,
      })
    })
}

export async function PUT(request: NextRequest) {
  const base = ApiUrl('ServerMode')
  const url = new URL(request.url)

  const options: RequestInit = {
    headers: {
      ...request.headers,
      'Content-Type': 'application/ld+json',
      Authorization: `Bearer ${request.cookies.get('token')?.value}`,
    },
    body: request.body,
    method: 'PUT',
  }

  const data = await fetchJson(base, `${url.pathname}${url.search}`, options)

  return NextResponse.json(data)
}
