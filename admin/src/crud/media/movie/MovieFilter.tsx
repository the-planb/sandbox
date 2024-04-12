import { EntityFilter, EntityFilterProps } from '@planb/components'
import React from 'react'
import * as Media from '@crud/media'

export const MovieFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Media.MovieSelect allowCreate={false} />
    </EntityFilter>
  )
}
