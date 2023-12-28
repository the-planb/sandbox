import React from 'react'
import { EntityFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'
import { EntityFilterProps } from '@planb/components/filters/EntityFilter/EntityFilter'

export const AuthorFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <BookStore.AuthorInput />
    </EntityFilter>
  )
}
