import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Music from '@crud/music'

type SongInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const SongInput = ({
  name,
  required,
  selectProps,
  ...props
}: SongInputProps) => {
  const itemToOption = (song: Music.Song) => ({
    label: Music.songRenderer(song),
    value: song['@id'],
  })

  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <Music.SongSelect {...selectProps} />
    </Form.Item>
  )
}
