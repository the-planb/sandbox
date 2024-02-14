import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Staff from '@crud/staff'

export const UserFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Staff.UserSelect allowCreate={false} />
    </EntityFilter>
  )
}
