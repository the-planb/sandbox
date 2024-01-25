import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Music from '@crud/music'

export const DiscoNameInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Music.discoNameValidator,
        },
      ]}>
      <Input
        placeholder={t('fields.name.placeholder', { ns: 'music/vo/discoName' })}
      />
    </Form.Item>
  )
}
