import { type AuthBindings } from '@refinedev/core'
import { ApiClient } from '@planb/provider'
import {
  type AuthTokenResponse,
  GetUser,
  OnCheck,
  OnError,
  OnLogin,
  Redirect,
} from './responses'

export function AuthProvider(): AuthBindings {
  const httpClient = ApiClient('ProxyMode')

  return {
    login: async ({ username, password, to }) => {
      return await httpClient
        .post('token/auth', {
          username,
          password,
        })
        .then((data: AuthTokenResponse) => {
          return data.code === 200 ? OnLogin(to) : OnError(data.message)
        })
        .catch((error) => {
          return OnError(error.message)
        })
    },
    logout: async () => {
      return await httpClient.get('token/logout').then(() => {
        return Redirect('/')
      })
    },
    check: async (ctx: any) => {
      const user = GetUser()
      return OnCheck(user !== null)
    },
    getPermissions: async () => {
      return GetUser()?.roles
    },
    getIdentity: async () => {
      return GetUser()
    },
    onError: async (error) => {
      return { error }
    },
  }
}
