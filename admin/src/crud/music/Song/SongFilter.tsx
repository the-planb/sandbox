import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Music from '@crud/music'

export const SongFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Music.SongInput allowCreate={false} />
    </EntityFilter>
  )
}
