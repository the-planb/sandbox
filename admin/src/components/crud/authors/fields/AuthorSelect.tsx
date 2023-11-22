import { type SelectProps } from 'antd'
import React from 'react'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components/fields/EntitySelect'
import { AuthorForm } from '@components/crud/authors'

export const AuthorSelect = (props: SelectProps) => {
  const itemToOption = (item: BaseRecord) => ({

    label: item ? `${item.name.firstName} ${item.name.lastName}` : null,
    value: item ? item['@id'] : null
  })

  const remote: RemoteFilter = (term: any) => {
    return {
      field: 'name',
      operator: 'partial',
      value: term
    }
  }

  return <EntitySelect
    {...props}
    resource={'bookstore/authors'}
    itemToOption={itemToOption}
    remote={remote}
    createForm={AuthorForm}
  />
}
