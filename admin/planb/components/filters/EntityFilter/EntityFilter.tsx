import { Select, Space } from 'antd'

import { cloneElement, ReactElement, useState } from 'react'
import { useDataProvider, useTranslate } from '@refinedev/core'
import { FilterData } from '@planb/components'
import css from './styles.module.scss'

const { Option } = Select

export interface EntityFilterProps {
  onChange?: (value: FilterData) => void
  value?: FilterData
  children: ReactElement
}

export const EntityFilter = ({
  value,
  onChange,
  children,
}: EntityFilterProps) => {
  const t = useTranslate()
  const dataProvider = useDataProvider()('default')

  const operators = {
    identity: t('filters.operators.identity'),
    not_identity: t('filters.operators.not_identity'),
  }

  const [data, setData] = useState({
    value: value?.value ?? null,
    operator: value?.operator ?? 'identity',
  })

  const triggerChange = (changedValue: Partial<FilterData>) => {
    const newData = {
      ...data,
      ...changedValue,
    }

    setData(newData)
    onChange?.(newData)
  }

  const onValueChange = (value: string) => {
    const pieces = value.split('/')
    const id = pieces.pop()

    triggerChange({ value: id })
  }

  const onOperatorChange = (operator: string) => {
    triggerChange({ operator })
  }

  const SelectInput = cloneElement(children, {
    // value: data.value,
    onChange: onValueChange,
    style: { width: '15em' },
  })

  return (
    <Space>
      <Select
        style={{ width: '5em' }}
        value={data.operator}
        onChange={onOperatorChange}>
        {Object.entries(operators).map(([operator, label]) => {
          return (
            <Option key={operator} value={operator}>
              {label}
            </Option>
          )
        })}
      </Select>

      {SelectInput}
    </Space>
  )
}
