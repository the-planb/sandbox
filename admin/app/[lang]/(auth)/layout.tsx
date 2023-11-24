import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'
import { AuthProvider } from '@planb/provider'
import { type PropsWithChildren } from 'react'

async function checkAuth(authCokkie: string | undefined) {
  return await AuthProvider().check(authCokkie)
}

export default async function ProtectedLayout({ children }: PropsWithChildren) {
  const cookieStore = cookies()
  const auth = cookieStore.getAll()

  // const { authenticated } = await checkAuth(auth?.value);
  const authenticated = false

  if (authenticated) {
    return redirect('/')
  } else {
    return <>{children}</>
  }
}
