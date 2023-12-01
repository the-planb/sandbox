import { Layout as AntdLayout } from 'antd'
import { LangSwitcher } from './langSwitcher'
import { UserPanel } from './userPanel'

import css from './style.module.scss'
import React from 'react'
import { CollapseToggle } from './collapseToggle'

export const Header: React.FC = () => {
  return (
    <AntdLayout.Header
      className={css.header}
      style={{
        padding: '0 1em 0 0',
        height: '70px',
      }}>
      <div className={'header-left'}>
        <CollapseToggle />
      </div>

      <div className={'header-center'}></div>

      <div className={'header-right'}>
        <LangSwitcher />
        <UserPanel />
      </div>
    </AntdLayout.Header>
  )
}
