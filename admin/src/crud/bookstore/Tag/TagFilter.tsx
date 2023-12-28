import React from 'react'
import { EntityFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const TagFilter = ({}) => {
  return (
    <EntityFilter>
      <BookStore.TagInput />
    </EntityFilter>
  )
}
