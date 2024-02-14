import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Staff from '@crud/staff'

export const UserNameInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Staff.userNameValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.name.placeholder', { ns: 'staff/vo/userName' })}
      />
    </Form.Item>
  )
}
