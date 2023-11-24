'use client'
import React, {
  createContext,
  type PropsWithChildren,
  useContext,
  useState,
} from 'react'

interface ILayoutContext {
  collapsed: boolean
  setCollapsed: (collapsed: boolean) => void
  toggleCollapsed: () => void
}

export const LayoutContext = createContext<ILayoutContext>({} as ILayoutContext)

export const useLayoutContext = (): ILayoutContext => {
  return useContext<ILayoutContext>(LayoutContext)
}

export const LayoutContextProvider = ({ children }: PropsWithChildren) => {
  const [collapsed, setCollapsed] = useState<boolean>(false)

  const context: ILayoutContext = {
    collapsed,
    setCollapsed,
    toggleCollapsed: () => {
      setCollapsed(!collapsed)
    },
  }

  return (
    <LayoutContext.Provider value={context}>{children}</LayoutContext.Provider>
  )
}
