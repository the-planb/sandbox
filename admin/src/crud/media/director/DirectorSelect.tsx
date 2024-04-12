import { type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import React from 'react'
import * as Media from '@crud/media'

type DirectorSelectProps = SelectProps & { allowCreate?: boolean }

export const DirectorSelect = ({
  allowCreate = true,
  value,
  ...props
}: DirectorSelectProps) => {
  const itemToOption = (director: Media.Director) => ({
    label: Media.directorRenderer(director),
    value: director['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'media/directors'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Media.useDirectorModalForm : undefined}
    />
  )
}
