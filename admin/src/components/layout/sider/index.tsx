'use client'

import React from 'react'
import { Grid, Layout as AntdLayout, Menu, type MenuProps } from 'antd'
import { useMenu, useTranslate } from '@refinedev/core'
import { type ItemType } from 'antd/es/menu/hooks/useItems'
import { Title } from '@components/layout/title'
import Link from 'next/link'
import { type TreeMenuItem } from '@refinedev/core/dist/hooks/menu/useMenu'
import { useLayoutContext } from '@contexts'

import css from './style.module.scss'

export const Sider = () => {
  const { collapsed, setCollapsed } = useLayoutContext()
  const translate = useTranslate()
  const { menuItems, selectedKey, defaultOpenKeys } = useMenu()
  const breakpoint = Grid.useBreakpoint()
  const isMobile = typeof breakpoint.lg === 'undefined' ? false : !breakpoint.lg

  type MenuItem = Required<MenuProps>['items'][number]

  function parseItem (item: TreeMenuItem): ItemType {
    const { route, name, icon, children, meta } = item
    const parent = meta?.parent ?? null
    const key = parent ? `/${parent}/${name}` : `/${name}`
    const anchor = translate(`${name.toLowerCase()}.titles.list`)

    if ((children ?? []).length > 0) {
      return {
        key,
        icon,
        style: {
          fontWeight: selectedKey === key ? 'bold' : 'normal'
        },
        label: anchor,
        children: children.map(parseItem)
      }
    }

    return {
      key,
      icon,
      style: {
        fontWeight: selectedKey === key ? 'bold' : 'normal'
      },
      label: <Link href={route}>{anchor}</Link>
    }
  }

  const onCollapse = (collapsed: boolean) => {
    setCollapsed(collapsed)
  }

  const items: MenuItem[] = menuItems.map(parseItem)

  return (

    <AntdLayout.Sider
      trigger={null}
      collapsible
      collapsed={collapsed}
      onCollapse={onCollapse}
      collapsedWidth={isMobile ? 0 : 80}
      breakpoint="lg"
      // theme={'light'}
    >
      <Title collapsed={collapsed}/>
      <Menu
        className={css.menu}
        selectedKeys={[selectedKey]}
        defaultOpenKeys={defaultOpenKeys}
        mode="inline"
        onClick={() => {
          if (!breakpoint.lg) {
            setCollapsed(true)
          }
        }}
        items={items}
      />
    </AntdLayout.Sider>

  )
}
