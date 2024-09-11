import React from 'react'
import { Form, InputNumber, Input, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import { Editor } from '@planb/components/fields'
import * as Media from '@crud/media'

export const GenreNameField = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Media.genreNameValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.name.placeholder', { ns: 'media/vo/genreName' })}
      />
    </Form.Item>
  )
}
