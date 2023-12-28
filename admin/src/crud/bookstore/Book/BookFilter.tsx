import React from 'react'
import { EntityFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const BookFilter = () => {
  return (
    <EntityFilter>
      <BookStore.BookInput />
    </EntityFilter>
  )
}
