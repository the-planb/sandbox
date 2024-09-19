import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Media from '@crud/media'

export const GenreFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Media.GenreSelect allowCreate={false} />
    </EntityFilter>
  )
}
