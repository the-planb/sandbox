import { Form, Input, InputNumber, Space } from 'antd'
import { FormItemProps } from 'antd/es/form/FormItem'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const PriceInput = ({ name, required, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
          validator: BookStore.priceValidator,
        },
      ]}>
      <InputNumber
        placeholder={t('fields.amount.placeholder', {
          ns: 'bookstore/vo/price',
        })}
      />
    </Form.Item>
  )
}
