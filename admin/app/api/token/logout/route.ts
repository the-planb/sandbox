import {NextRequest, NextResponse} from "next/server";
import {cookies} from "next/headers";

export async function GET(request: NextRequest) {

  cookies().delete('token')
  cookies().delete('auth')

  return NextResponse.json({code: 200}, {
    status: 200
  })
}
