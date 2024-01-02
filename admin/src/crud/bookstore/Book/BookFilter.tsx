import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const BookFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <BookStore.BookInput allowCreate={false} />
    </EntityFilter>
  )
}
