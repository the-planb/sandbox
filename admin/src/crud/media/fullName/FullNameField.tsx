import React from 'react'
import { Form, InputNumber, Input, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import { Editor } from '@planb/components/fields'
import * as Media from '@crud/media'

export const FullNameField = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Media.fullNameValidator,
        },
      ]}>
      <Input.Group compact className={'input-group-multiple-wrapper'}>
        <Form.Item
          name={[name, 'name']}
          label={t('fields.name.label', { ns: 'media/vo/fullName' })}
          required={false}>
          <Input
            placeholder={t('fields.name.placeholder', {
              ns: 'media/vo/fullName',
            })}
          />
        </Form.Item>

        <Form.Item
          name={[name, 'lastName']}
          label={t('fields.lastName.label', { ns: 'media/vo/fullName' })}
          required={false}>
          <Input
            placeholder={t('fields.lastName.placeholder', {
              ns: 'media/vo/fullName',
            })}
          />
        </Form.Item>
      </Input.Group>
    </Form.Item>
  )
}
