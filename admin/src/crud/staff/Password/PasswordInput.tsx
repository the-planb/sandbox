import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Staff from '@crud/staff'

export const PasswordInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Staff.passwordValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.password.placeholder', {
          ns: 'staff/vo/password',
        })}
      />
    </Form.Item>
  )
}
