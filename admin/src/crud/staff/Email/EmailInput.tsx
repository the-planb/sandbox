import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Staff from '@crud/staff'

export const EmailInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Staff.emailValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.email.placeholder', { ns: 'staff/vo/email' })}
      />
    </Form.Item>
  )
}
