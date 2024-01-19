import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as Music from '@crud/music'

export const DiscoInput = ({
  allowCreate = true,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (disco: Music.Disco) => ({
    label: Music.discoRenderer(disco),
    value: disco['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'music/discos'}
      itemToOption={itemToOption}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Music.useDiscoModalForm : undefined}
    />
  )
}
