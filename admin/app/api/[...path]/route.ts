import { type NextRequest, NextResponse } from 'next/server'
import { iriComposer } from '@planb/provider/ApiClient/iriComposer'

const BASE_URL: string = `http://php`

type DoFetchReturnType = {
  data: object
  status: number
  ok: boolean
}

interface RequestConfig {
  url: string
  options: RequestInit
}

const configureRequest = (request: NextRequest): RequestConfig => {
  // const XPreload = request.headers.get('X-Preload')
  // const Preload: { Preload: string } | {} = XPreload
  //   ? { Preload: XPreload }
  //   : {}

  const body = ['PUT', 'POST'].includes(request.method)
    ? {
        body: request.body,
        duplex: 'half',
      }
    : {}

  const options: RequestInit = {
    method: request.method,
    // cache: 'reload',
    ...body,

    headers: {
      'Content-Type': 'application/ld+json',
      Authorization: `Bearer ${request.cookies.get('token')?.value}`,
      //...Preload,
    },
  }

  const url = new URL(request.url)
  const endpoint = `${BASE_URL}${url.pathname}${url.search}`

  return { url: endpoint, options }
}

const doFetch = async ({
  url,
  options,
}: RequestConfig): Promise<DoFetchReturnType> => {
  return await fetch(url, options)
    .then(async (res) => {
      const responseText = await res.text()
      try {
        if (res.status === 204 && options.method === 'DELETE') {
          return {
            data: {},
            status: 200,
            ok: true,
          }
        }

        const data = JSON.parse(responseText)
        return {
          data,
          status: res.status,
          ok: true,
        }
      } catch (error) {
        console.log({ error }, '<----')

        return Promise.reject({
          data: {
            raw: responseText,
          },
          status: res.status,
          ok: false,
        })
      }
    })
    .catch((error) => {
      console.log({ error })
      return error
    })
}

export async function GET(request: NextRequest) {
  const { url, options } = configureRequest(request)
  const { data, status, ok } = await doFetch({ url, options })

  if (ok) {
    await iriComposer({
      baseUrl: BASE_URL,
      data,
      preload: request.headers.get('X-Preload'),
      options,
    })
  }
  return NextResponse.json(data, {
    status,
  })
}

export async function PUT(request: NextRequest) {
  const { url, options } = configureRequest(request)
  const { data, status, ok } = await doFetch({ url, options })

  return NextResponse.json(data, {
    status,
  })
}

export async function POST(request: NextRequest) {
  const { url, options } = configureRequest(request)
  const { data, status, ok } = await doFetch({ url, options })

  return NextResponse.json(data, {
    status,
  })
}

export async function DELETE(request: NextRequest) {
  const { url, options } = configureRequest(request)
  const { data, status, ok } = await doFetch({ url, options })

  return NextResponse.json(data, {
    status,
  })
}
