import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const TagNameInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: BookStore.tagNameValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.name.placeholder', {
          ns: 'bookstore/vo/tagName',
        })}
      />
    </Form.Item>
  )
}
