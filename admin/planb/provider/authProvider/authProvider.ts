import { type AuthBindings } from '@refinedev/core'
// import { ApiClient } from '@planb/provider'
import { GetUser, OnCheck, OnError, OnLogin, Redirect } from './responses'
import { fetchData } from '@planb/provider'

export function AuthProvider(): AuthBindings {
  // const httpClient = ApiClient('ProxyMode')

  return {
    login: async ({ username, password, to }) => {
      const { error, data, status } = await fetchData({
        path: 'admin/api/token/auth',
        method: 'POST',
        body: JSON.stringify({
          username,
          password,
        }) as BodyInit,
      })

      if (error) {
        return OnError(error['hydra:description'] || 'An error occurred')
      }

      return OnLogin(to)
    },
    logout: async () => {
      const { error, data, status } = await fetchData({
        path: 'admin/api/token/logout',
        method: 'GET',
      })
      if (error) {
        return OnError('Logout error occurred')
      }

      return Redirect('/')
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
