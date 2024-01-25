import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const AuthorFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <BookStore.AuthorSelect allowCreate={false} />
    </EntityFilter>
  )
}
