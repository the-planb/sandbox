import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Music from '@crud/music'

export const DiscoFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Music.DiscoSelect allowCreate={false} />
    </EntityFilter>
  )
}
