import { Form, InputNumber, Input, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import { Editor } from '@planb/components/fields'
import React from 'react'
import * as Media from '@crud/media'

export const ReleaseYearField = ({
  name,
  required,
  ...props
}: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <InputNumber
        placeholder={t('fields.year.placeholder', {
          ns: 'media/vo/releaseYear',
        })}
      />
    </Form.Item>
  )
}
