import { Button } from 'antd'
import Icon from '../../../icon'
import React from 'react'
import { useLayoutContext } from '@contexts'

export const CollapseToggle = () => {
  const { toggleCollapsed } = useLayoutContext()

  return (
    <Button
      type='link'
      style={{ paddingRight: '0px' }}
      onClick={() => {
        toggleCollapsed()
      }}>
      <Icon.Menu />
    </Button>
  )
}
