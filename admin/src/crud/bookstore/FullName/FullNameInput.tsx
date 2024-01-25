import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const FullNameInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      rules={[
        {
          required,
          validator: BookStore.fullNameValidator,
        },
      ]}>
      <Space>
        <Form.Item noStyle name={[name, 'firstName']}>
          <Input
            placeholder={t('fields.firstName.placeholder', {
              ns: 'bookstore/vo/fullName',
            })}
          />
        </Form.Item>
        <Form.Item noStyle name={[name, 'lastName']}>
          <Input
            placeholder={t('fields.lastName.placeholder', {
              ns: 'bookstore/vo/fullName',
            })}
          />
        </Form.Item>
      </Space>
    </Form.Item>
  )
}
