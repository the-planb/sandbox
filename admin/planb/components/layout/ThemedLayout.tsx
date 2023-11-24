import React from 'react'
import { Grid, Layout as AntdLayout } from 'antd'
import {
  type RefineThemedLayoutV2Props,
  ThemedHeaderV2,
  ThemedLayoutContextProvider,
  ThemedSiderV2,
} from '@refinedev/antd'

export default function ThemedLayout({
  children,
  Header,
  Sider,
  Title,
  Footer,
  OffLayoutArea,
  initialSiderCollapsed,
}: RefineThemedLayoutV2Props) {
  const breakpoint = Grid.useBreakpoint()
  const SiderToRender = Sider ?? ThemedSiderV2
  const HeaderToRender = Header ?? ThemedHeaderV2
  const isSmall = typeof breakpoint.sm === 'undefined' ? true : breakpoint.sm

  return (
    <ThemedLayoutContextProvider initialSiderCollapsed={initialSiderCollapsed}>
      <AntdLayout style={{ minHeight: '100vh' }}>
        <SiderToRender Title={Title} />
        <AntdLayout>
          <HeaderToRender />
          <AntdLayout.Content>
            <div
              style={{
                height: '100%',
                maxHeight: '93vh',
                padding: isSmall ? 24 : 12,
              }}>
              {children}
            </div>
            {OffLayoutArea && <OffLayoutArea />}
          </AntdLayout.Content>
          {Footer && <Footer />}
        </AntdLayout>
      </AntdLayout>
    </ThemedLayoutContextProvider>
  )
}
