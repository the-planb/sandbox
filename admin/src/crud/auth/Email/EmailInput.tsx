import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Auth from '@crud/auth'

export const EmailInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Auth.emailValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.email.placeholder', { ns: 'auth/vo/email' })}
      />
    </Form.Item>
  )
}
