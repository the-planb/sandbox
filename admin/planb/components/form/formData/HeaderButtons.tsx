import { ListButton, RefreshButton } from '@refinedev/antd'
import React from 'react'
import { Space } from 'antd'
import { useTranslate } from '@refinedev/core'

type HeaderButtonsProps = {
  resource: string
}

export const HeaderButtons = ({ resource }: HeaderButtonsProps) => {
  const t = useTranslate()

  return (
    <Space>
      <ListButton resource={resource}>
        {t('titles.list', { ns: resource })}
      </ListButton>
      <RefreshButton resource={resource} />
    </Space>
  )
}
