import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const TagFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <BookStore.TagSelect allowCreate={false} />
    </EntityFilter>
  )
}
