import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Music from '@crud/music'

type DiscoInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const DiscoInput = ({
  name,
  required,
  selectProps,
  ...props
}: DiscoInputProps) => {
  const itemToOption = (disco: Music.Disco) => ({
    label: Music.discoRenderer(disco),
    value: disco['@id'],
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
      <Music.DiscoSelect {...selectProps} />
    </Form.Item>
  )
}
