'use client'

import { Header, type LayoutProps, Sider } from 'src/layout'
import { Authenticated } from '@refinedev/core'
import ThemedLayout from '@planb/components/layout'

export default function Layout({ children, params }: LayoutProps) {
  const { lang } = params

  return (
    <Authenticated
      key='private'
      redirectOnFail={`/${lang}/login`}
      v3LegacyAuthProviderCompatible>
      <ThemedLayout Sider={Sider} Header={Header}>
        {children}
      </ThemedLayout>
    </Authenticated>
  )
}
