import { createContext, useContext } from 'react'
import { type ErrorBag } from './errorBag'

export const ErrorBagContext = createContext<ErrorBag>({} as ErrorBag)

export const useErrorBag = (): ErrorBag => {
  return useContext<ErrorBag>(ErrorBagContext)
}
