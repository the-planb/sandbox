import { useSelect } from '@refinedev/antd'
import { Select, SelectProps } from 'antd'
import { DefaultOptionType } from 'rc-select/es/Select'
import React, { useState } from 'react'
import { BaseKey, BaseRecord, HttpError, useTranslate } from '@refinedev/core'
import { uniqBy } from 'lodash'
import { LogicalFilter } from '@refinedev/core/src/contexts/data/IDataContext'
import { CreateEntityButton } from '@planb/components/fields/CreateEntityButton'
import { UseFormFunction } from '@planb/components'

const valueToId = (value?: string | BaseRecord | string[] | BaseRecord[]) => {
  if (value === undefined) {
    return undefined
  }
  const data = (Array.isArray(value) ? value : [value]).filter((value) => value)
  return data.map((item) => {
    if (typeof item === 'object') {
      return item['id'] as BaseKey
    }

    return item.split('/').pop() as BaseKey
  })
}

type EntitySelectProps<TData extends BaseRecord> = SelectProps & {
  resource: string
  itemToOption: (item: TData) => DefaultOptionType
  remote?: Omit<LogicalFilter, 'value'>
  useCreateForm?: UseFormFunction<TData>
}

export const EntitySelect = <TData extends BaseRecord>({
  itemToOption,
  resource,
  remote,
  onChange,
  useCreateForm,
  ...props
}: EntitySelectProps<TData>) => {
  const t = useTranslate()
  const [value, setValue] = useState<string | string[] | undefined>(props.value)
  const { selectProps, queryResult, defaultValueQueryResult } = useSelect<
    TData,
    HttpError,
    TData
  >({
    resource,
    defaultValue: valueToId(value),
    debounce: 500,
    pagination: {
      pageSize: 10,
    },
    queryOptions: {
      retry: 0,
    },
    onSearch:
      remote != undefined
        ? (value) => [
            {
              ...remote,
              value,
            },
          ]
        : undefined,
  })

  const data: DefaultOptionType[] = [
    ...(queryResult.data?.data || []),
    ...(defaultValueQueryResult.data?.data || []),
  ]
    .filter((item) => item)
    .map(itemToOption)

  const options = uniqBy(data, 'value')

  return (
    <>
      <Select
        {...{
          ...selectProps,
          onChange: (value, option) => {
            if (!onChange) {
              return
            }
            setValue(value)
            onChange(value, option)
          },
          ...props,
          options,

          ...(remote !== undefined
            ? {}
            : {
                onSearch: undefined,
                filterOption: true,
                optionFilterProp: 'label',
              }),
        }}
      />

      {useCreateForm !== undefined && (
        <CreateEntityButton
          useCreateForm={useCreateForm}
          itemToOption={itemToOption}
          value={value}
          setValue={setValue}
          onChange={onChange}
          mode={props.mode}>
          {t('titles.create', { ns: resource })}
        </CreateEntityButton>
      )}
    </>
  )
}
