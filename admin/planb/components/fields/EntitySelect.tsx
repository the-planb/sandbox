import { Button, Select, type SelectProps } from 'antd'
import React, { type FC, useEffect, useState } from 'react'
import { type BaseRecord, type CrudFilter, useCan, useDataProvider, useTranslate } from '@refinedev/core'
import { type DefaultOptionType } from 'rc-select/es/Select'
import { type FormDataProps, useFormData } from '@planb/components/form/formData'
import { UseFormProps } from '@refinedev/antd/src/hooks/form/useForm'

const _ = require('lodash')

interface EntitySelectProps<T extends BaseRecord> extends SelectProps {
  resource: string
  itemToOption: (item: T) => DefaultOptionType
  searchFilter: {
    field: string
    operator: string
  }
  createForm?: FC<FormDataProps>
}

interface CreateButtonProps {
  resource: string
  createForm: FC<FormDataProps>
  onMutationSuccess: UseFormProps['onMutationSuccess']
}

const CreateButton = ({
                        resource,
                        createForm,
                        onMutationSuccess,
                      }: CreateButtonProps) => {
  const t = useTranslate()

  const { show, ...props } = useFormData({
    resource,
    action: 'create',
    like: 'modal',
    onMutationSuccess,
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
  const { resource, itemToOption, createForm, searchFilter, ...props } = selectProps
  const { data: role } = useCan({ resource, action: 'create' })
  const dataProvider = useDataProvider()('default')
  const [reloaded, setReload] = useState<Boolean>(false)
  const [data, setData] = useState<BaseRecord[]>([])
  const [total, setTotal] = useState<number>(-1)
  const [value, setValue] = useState<DefaultOptionType | DefaultOptionType[] | undefined>([])

  const updateValue = (value: undefined | DefaultOptionType[] | DefaultOptionType) => {
    if (Array.isArray(value)) {
      setValue(value)
      const mapped = value.map((option: DefaultOptionType) => option.value)
      if (mapped.length > 0) {
        props.onChange?.(mapped, value)
      }
    } else {
      setValue(value)
      if (value) {
        props.onChange?.(value?.value, value)
      }
    }

  }

  useEffect(() => {
    dataProvider
      .getList({ resource, pagination: { pageSize: MAX } })
      .then((response) => {
        setTotal(response.total)
        const data = response.total <= MAX ? response.data : []
        const values = Array.isArray(props.value) ? props.value : []
        const merged = _.uniqBy([
          ...values,
          ...data,
        ], 'id')

        setData(merged)

      })
  }, [reloaded])


  useEffect(() => {

    if (['tags', 'multiple'].includes(props.mode as string)) {
      let temp = props.value || []
      temp = Array.isArray(temp) ? temp : [temp]
      const value = temp.map(itemToOption)
      updateValue(value)
      return
    } else {
      const value = props.value ? itemToOption(props.value) : undefined
      updateValue(value)
    }

  }, [])

  const onChange = (
    value: any,
    option: DefaultOptionType | DefaultOptionType[],
  ) => {
    props.onChange?.(value, option)
    setValue(option)
  }

  const onSearch = (term: string) => {
    if (term.length < 2) return
    const filters = [
      {
        ...searchFilter,
        value: term,
      } as CrudFilter,
    ]
    dataProvider.getList({ resource, filters }).then((response) => {
      setData(response.data)
    })
  }
  const search = total > MAX ? { onSearch } : {}

  return (
    <>
      <Select
        {...props}
        options={data.map((record) => itemToOption(record as T))}
        showSearch={total > MAX}
        value={value}
        onChange={onChange}
        {...search}
        filterOption={(input, option) => {
          return (option?.label as string).toLowerCase().includes(input.toLowerCase())
        }}
        notFoundContent={null}
      />

      {role?.can && createForm != undefined && (
        <CreateButton
          resource={resource}
          createForm={createForm}
          onMutationSuccess={(data) => {
            if (Array.isArray(value)) {
              const merged: DefaultOptionType[] = [
                ...value,
                itemToOption(data.data as unknown as T),
              ]
              updateValue(merged)
            } else {
              updateValue(itemToOption(data.data as unknown as T))
            }
            setReload(!reloaded)
          }}
        />
      )}
    </>
  )
}
