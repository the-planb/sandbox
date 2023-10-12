import {getCookie} from 'typescript-cookie'

export interface AuthTokenResponse {
  code: number,
  message: string
}

export function OnLogin(redirectTo: string) {
  return Redirect(redirectTo)
}


export const OnError = (message: string) => {
  return {
    success: false,
    error: {
      name: 'Error Login',
      message: message
    }
  }
}


export const OnCheck = (authenticated: boolean) => {
  return authenticated ? {
    authenticated: true,
  } : {
    authenticated: false,
    logout: true,
    redirectTo: "/login",
  }
}


export const GetUser = () => {
  const auth = getCookie('auth')
  return auth ? JSON.parse(atob(auth)) : null
}


export const Redirect = (redirectTo: string) => {
  return {
    success: true,
    redirectTo,
  }
}
