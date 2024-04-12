import { type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import React from 'react'
import * as Media from '@crud/media'

type GenreSelectProps = SelectProps & { allowCreate?: boolean }

export const GenreSelect = ({
  allowCreate = true,
  value,
  ...props
}: GenreSelectProps) => {
  const itemToOption = (genre: Media.Genre) => ({
    label: Media.genreRenderer(genre),
    value: genre['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'media/genres'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Media.useGenreModalForm : undefined}
    />
  )
}
