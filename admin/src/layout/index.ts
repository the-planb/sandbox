import { type PropsWithChildren } from 'react'

export { Header } from './header'
export { Sider } from './sider'

export type LayoutProps = PropsWithChildren & {
  params: {
    lang: string
  }
}

export interface PageProps {
  params: {
    lang: string
    [key: string]: string | undefined
  }
  searchParams: Record<string, undefined>
}
