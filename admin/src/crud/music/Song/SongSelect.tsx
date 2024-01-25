import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Music from '@crud/music'

export const SongSelect = ({
  allowCreate = true,
  value,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (song: Music.Song) => ({
    label: Music.songRenderer(song),
    value: song['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'music/songs'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Music.useSongModalForm : undefined}
    />
  )
}
