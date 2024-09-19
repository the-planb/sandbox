import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Media from '@crud/media'

export const DirectorFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Media.DirectorSelect allowCreate={false} />
    </EntityFilter>
  )
}
