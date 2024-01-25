import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const TitleInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: BookStore.titleValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.title.placeholder', {
          ns: 'bookstore/vo/title',
        })}
      />
    </Form.Item>
  )
}
