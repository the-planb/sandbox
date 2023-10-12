import {PropsWithChildren} from "react";

export {Header} from './header'
export {Sider} from './sider'


export type LayoutProps = PropsWithChildren & {
  params: {
    lang: string
  }
}
//
// export type LayoutPropsWithChildren = PropsWithChildren & LayoutProps

export type PageProps = {
  params: {
    lang: string,
    [key: string]: string | undefined
  },
  searchParams: {
    [key: string]: undefined
  }
}
