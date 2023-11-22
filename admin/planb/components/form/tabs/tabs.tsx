import slug from 'slug'
import { type Tab } from 'rc-tabs/lib/interface'

import React from 'react'
import { TabLabel } from './TabLabel'

interface TabArgs extends Omit<Tab, 'key' | 'label'> {
  key?: string
  label: string
}

export const tab = (props: TabArgs): Tab => {
  const { label, children, ...tabProps } = props
  const key = slug(label)

  return {
    key,
    forceRender: true,
    label: <TabLabel label={label}/>,
    children,
    ...tabProps
  }
}
