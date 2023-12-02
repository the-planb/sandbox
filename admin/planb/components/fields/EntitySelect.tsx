import { Button, Select, type SelectProps } from 'antd'
import React, { type FC, useEffect, useState } from 'react'
import {
  type BaseRecord,
  type CrudFilter,
  useCan,
  useDataProvider,
  useTranslate,
} from '@refinedev/core'
import { type DefaultOptionType, type FilterFunc } from 'rc-select/es/Select'
import { type FormDataProps, useFormData } from '@planb/components/form/formData'

interface EntitySelectProps<T extends BaseRecord> extends SelectProps {
  resource: string
  itemToOption: (item: T) => DefaultOptionType
  remote?: RemoteFilter
  createForm?: FC<FormDataProps>
}

export type RemoteFilter = (term: string) => {
  field: string
  operator: string
  value: any
}

interface CreateButtonProps {
  resource: string
  createForm: FC<FormDataProps>
}

const CreateButton = ({ resource, createForm }: CreateButtonProps) => {
  const t = useTranslate()

  const { show, ...props } = useFormData({
    resource,
    action: 'create',
    like: 'modal',
  })

  return (
    <>
      <Button
        type='link'
        style={{ paddingLeft: 0 }}
        onClick={() => {
          show()
        }}>
        {t(`${resource}.titles.create`)}
      </Button>

      {createForm(props)}
    </>
  )
}

export const EntitySelect = <T extends BaseRecord>(
  selectProps: EntitySelectProps<T>,
) => {
  const { resource, itemToOption, createForm, remote, ...props } = selectProps
  const { data: role } = useCan({
    resource,
    action: 'create',
  })
  const dataProvider = useDataProvider()('default')
  const [data, setData] = useState<BaseRecord[]>([])
  const [value, setValue] = useState<
    DefaultOptionType | DefaultOptionType[] | undefined
  >([])

  useEffect(() => {
    if (['tags', 'multiple'].includes(props.mode as string)) {

      const value = ([props.value]).map(itemToOption)
      setValue(value)

      const mapped = value.map((option: DefaultOptionType) => option.value)
      props.onChange?.(mapped, value)
      return
    }

    const value = props.value ? itemToOption(props.value) : undefined
    setValue(value)

    if (value) {
      props.onChange?.(value?.value, value)
    }
  }, [])

  useEffect(() => {
    if (remote) {
      if (['tags', 'multiple'].includes(props.mode as string)) {
        setData(props.value ?? [])
        return
      }
      setData([])
      return
    }

    dataProvider
      .getList({
        resource,
      })
      .then((response) => {
        setData(response.data)
      })
  }, [remote])

  const onChange = (
    value: any,
    option: DefaultOptionType | DefaultOptionType[],
  ) => {
    props.onChange?.(value, option)
    setValue(option)
  }

  const filterOption: FilterFunc<DefaultOptionType> = (input, option) => {
    return (option?.label as string).toLowerCase().includes(input.toLowerCase())
  }

  const onSearch = (term: string) => {
    const filters = remote ? [remote(term) as CrudFilter] : undefined

    dataProvider
      .getList({
        resource,
        filters,
      })
      .then((response) => {
        setData(response.data)
      })
  }

  const search = remote
    ? {
      onSearch,
    }
    : {}

  return (
    <>
      <Select
        {...props}
        options={data.map((record) => itemToOption(record as T))}
        showSearch={true}
        value={value}
        onChange={onChange}
        {...search}
        filterOption={filterOption}
      />

      {role?.can && createForm != undefined && (
        <CreateButton resource={resource} createForm={createForm} />
      )}
    </>
  )
}
