import { Input, InputNumber, type InputProps, Space } from 'antd'
import { type ChangeEvent } from 'react'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

interface FullNameInputProps extends Omit<InputProps, 'value' | 'onChange'> {
  value?: BookStore.FullName
  onChange?: (data: BookStore.FullName) => void
}

export const FullNameInput = ({ value, onChange }: FullNameInputProps) => {
  const triggerChange = (data: Partial<BookStore.FullName>) => {
    onChange?.({
      ...(value as BookStore.FullName),
      ...data,
    })
  }
  const t = useTranslate()
  return (
    <Space>
      <Input
        value={value?.firstName}
        placeholder={t('bookstore.fullname.firstname')}
        onChange={(el: ChangeEvent<HTMLInputElement>) => {
          triggerChange({
            firstName: el.target.value,
          })
        }}
      />
      <Input
        value={value?.lastName}
        placeholder={t('bookstore.fullname.lastname')}
        onChange={(el: ChangeEvent<HTMLInputElement>) => {
          triggerChange({
            lastName: el.target.value,
          })
        }}
      />
    </Space>
  )
}
