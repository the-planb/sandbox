import { type Money } from '@model'
import { type RuleObject } from 'rc-field-form/es/interface'
import { InputNumber, type InputProps, Select } from 'antd'

interface PriceInputProps extends Omit<InputProps, 'value' | 'onChange'> {
  value?: Money
  onChange?: (data: Money) => void
}

export const PriceRule = async (rule: RuleObject, value: Money) => {
  const { amount } = value

  if (amount > 0) {
    await Promise.resolve()
    return
  }
  return await Promise.reject('Price must be greater than zero!')
}

export const PriceInput = (props: PriceInputProps) => {
  const { value = { amount: 0, currency: 'EUR' }, onChange } = props

  const triggerChange = (data: Partial<Money>) => {
    onChange?.({
      amount: value.amount,
      currency: value?.currency,
      ...data,
    })
  }

  const currencySelect = (
    <Select
      value={value?.currency ?? 'EUR'}
      options={[
        { value: 'EUR', label: '€' },
        { value: 'DOL', label: '$' },
      ]}
      onChange={(currency) => {
        triggerChange({
          currency: currency ?? 'EUR',
        })
      }}
    />
  )

  return (
    <>
      <InputNumber
        value={value?.amount}
        addonAfter={currencySelect}
        onChange={(amount) => {
          triggerChange({
            amount: amount ?? 0,
          })
        }}
      />
    </>
  )
}
