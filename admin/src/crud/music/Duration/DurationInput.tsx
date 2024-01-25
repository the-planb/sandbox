import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as Music from '@crud/music'

export const DurationInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: Music.durationValidator,
        },
      ]}>
      <InputNumber
        placeholder={t('fields.duration.placeholder', {
          ns: 'music/vo/duration',
        })}
      />
    </Form.Item>
  )
}
