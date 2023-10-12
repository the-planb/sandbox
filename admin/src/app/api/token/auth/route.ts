import {NextRequest, NextResponse} from "next/server";
import {decode, JwtPayload} from "jsonwebtoken";
import {cookies} from "next/headers";
import {ApiUrl} from "@planb/provider";

const SetCookies = (data: { token: string, }) => {


  const jwt = decode(data.token) as JwtPayload
  const exp = new Date(jwt.exp as number * 1000)
  const user = btoa(JSON.stringify(jwt))

  cookies().set('token', data.token, {
    path: '/',
    httpOnly: true,
    secure: true,
    sameSite: "lax",
    expires: exp
  })

  cookies().set('auth', user, {
    path: '/',
    httpOnly: false,
    secure: true,
    sameSite: "lax",
    expires: exp
  })
}

export async function POST(request: NextRequest) {
  const data = await request.json()
  const url = ApiUrl('ServerMode', 'token/auth')

  const res = await fetch(url, {
    headers: {
      'Content-Type': 'application/ld+json',
      'Accept': 'application/ld+json'
    },
    body: JSON.stringify(data),
    method: 'POST'
  })

  const {status} = res
  const json = await res.json()

  if (200 !== status) {
    return NextResponse.json(json, {
      status
    })
  }


  SetCookies(json)
  return NextResponse.json({code: 200}, {
    status
  })
}
