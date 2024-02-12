import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Auth from '@crud/auth'

export const UserNameInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Auth.userNameValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.name.placeholder', { ns: 'auth/vo/userName' })}
      />
    </Form.Item>
  )
}
