import { EntityFilter, EntityFilterProps } from '@planb/components'
import React from 'react'
import * as Media from '@crud/media'

export const ReviewFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Media.ReviewSelect allowCreate={false} />
    </EntityFilter>
  )
}
