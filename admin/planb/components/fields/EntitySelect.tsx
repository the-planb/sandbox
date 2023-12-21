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
import {
  type FormDataProps,
  useFormData,
} from '@planb/components/form/formData'
import SkeletonInput from 'antd/es/skeleton/Input'

interface EntitySelectProps<T extends BaseRecord> extends SelectProps {
  resource: string
  itemToOption: (item: T) => DefaultOptionType
  searchFilter: {
    field: string
    operator: string
  }
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
  const MAX = 10

  const { resource, itemToOption, createForm, searchFilter, ...props } =
    selectProps
  const { data: role } = useCan({ resource, action: 'create' })
  const dataProvider = useDataProvider()('default')
  const [data, setData] = useState<BaseRecord[]>([])
  const [total, setTotal] = useState<number>(-1)
  const [value, setValue] = useState<
    DefaultOptionType | DefaultOptionType[] | undefined
  >([])

  useEffect(() => {
    if (['tags', 'multiple'].includes(props.mode as string)) {
      let temp = props.value || []
      temp = Array.isArray(temp) ? temp : [temp]

      const value = temp.map(itemToOption)
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
    dataProvider
      .getList({ resource, pagination: { pageSize: MAX } })
      .then((response) => {
        setTotal(response.total)
        const data = response.total <= MAX ? response.data : []
        setData(data)
      })
  }, [])

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

  const applyFilters = (term: string): CrudFilter[] => {
    return [
      {
        ...searchFilter,
        value: term,
      } as CrudFilter,
    ]
  }

  const onSearch = (term: string) => {
    if (term.length < 2) return
    const filters = applyFilters(term)

    dataProvider.getList({ resource, filters }).then((response) => {
      setData(response.data)
    })
  }

  const search = total > MAX ? { onSearch } : {}

  if (total < 0) return <SkeletonInput active={true} />
  return (
    <>
      <Select
        {...props}
        options={data.map((record) => itemToOption(record as T))}
        showSearch={total > MAX}
        value={value}
        onChange={onChange}
        {...search}
        filterOption={filterOption}
        notFoundContent={null}
      />

      {role?.can && createForm != undefined && (
        <CreateButton resource={resource} createForm={createForm} />
      )}
    </>
  )
}
