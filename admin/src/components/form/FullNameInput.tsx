import { type FullName } from '@model'
import { type RuleObject } from 'rc-field-form/es/interface'
import { Input, type InputProps, Space } from 'antd'
import { type ChangeEvent } from 'react'

interface FullNameInputProps extends Omit<InputProps, 'value' | 'onChange'> {
  value?: FullName
  onChange?: (data: FullName) => void
}

export const FullNameRule = async (rule: RuleObject, value: FullName) => {
  await Promise.resolve()
  // const {amount} = value
  //
  // if (amount > 0) {
  //   return Promise.resolve()
  // }
  // return Promise.reject('FullName must be greater than zero!')
}

export const FullNameInput = ({ value, onChange }: FullNameInputProps) => {
  const triggerChange = (data: Partial<FullName>) => {
    console.log(value, data)

    onChange?.({
      ...(value as FullName),
      ...data,
    })
  }

  return (
    <Space>
      <Input
        value={value?.firstName}
        placeholder={'Nombre'}
        onChange={(el: ChangeEvent<HTMLInputElement>) => {
          const firstName = el.target.value
          triggerChange({
            firstName,
          })
        }}
      />

      <Input
        value={value?.lastName}
        placeholder={'Apellidos'}
        onChange={(el: ChangeEvent<HTMLInputElement>) => {
          const lastName = el.target.value
          triggerChange({
            lastName,
          })
        }}
      />
    </Space>
  )
}
