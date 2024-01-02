import { Input, Select, Space } from 'antd'

import { useState } from 'react'
import { useTranslate } from '@refinedev/core'
import { FilterData } from '@planb/components'

const { Option } = Select

interface TextFilterProps {
  onChange?: (value: FilterData) => void
  value?: FilterData
}

export const TextFilter = ({ value, onChange }: TextFilterProps) => {
  const t = useTranslate()
  const operators = {
    equals: t('filters.operators.equals'),
    not_equals: t('filters.operators.not_equals'),
    contains: t('filters.operators.contains'),
    not_contains: t('filters.operators.not_contains'),
    starts: t('filters.operators.starts'),
    ends: t('filters.operators.ends'),
  }

  const [data, setData] = useState({
    value: value?.value ?? null,
    operator: value?.operator ?? 'contains',
  })

  const triggerChange = (changedValue: Partial<FilterData>) => {
    const newData = {
      ...data,
      ...changedValue,
    }

    setData(newData)
    onChange?.(newData)
  }

  const onValueChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = e.target.value
    triggerChange({ value })
  }

  const onOperatorChange = (operator: string) => {
    triggerChange({ operator })
  }

  return (
    <Space>
      <Select
        value={data.operator}
        onChange={onOperatorChange}
        style={{ width: '9em' }}>
        {Object.entries(operators).map(([operator, label]) => {
          return (
            <Option key={operator} value={operator}>
              {label}
            </Option>
          )
        })}
      </Select>

      <Input value={data.value} onChange={onValueChange} style={{ width: '11em' }} />
    </Space>
  )
}
