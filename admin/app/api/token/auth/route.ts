import { type NextRequest, NextResponse } from 'next/server'
import { decode, type JwtPayload } from 'jsonwebtoken'
import { cookies } from 'next/headers'

const BASE_URL: string = `http://php`

const SetCookies = (data: { token: string }) => {
  const jwt = decode(data.token) as JwtPayload
  const exp = new Date((jwt.exp as number) * 1000)
  const user = btoa(JSON.stringify(jwt))

  cookies().set('token', data.token, {
    path: '/',
    httpOnly: true,
    secure: true,
    sameSite: 'lax',
    expires: exp,
  })

  cookies().set('auth', user, {
    path: '/',
    httpOnly: false,
    secure: true,
    sameSite: 'lax',
    expires: exp,
  })
}

export async function POST(request: NextRequest) {
  const body = {
    body: request.body,
    duplex: 'half',
  }

  const url = `${BASE_URL}/api/token/auth`
  //
  const res = await fetch(url, {
    headers: {
      'Content-Type': 'application/ld+json',
      Accept: 'application/ld+json',
    },
    ...body,
    method: 'POST',
  })

  const { status } = res
  const json = await res.json()

  if (status !== 200) {
    return NextResponse.json(
      {
        'hydra:description': json.message,
      },
      {
        status,
      },
    )
  }

  SetCookies(json)
  return NextResponse.json(
    { code: 200 },
    {
      status,
    },
  )
}
