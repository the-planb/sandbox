import React from 'react'
import { EntityFilter, EntityFilterProps } from '@planb/components'
import * as Auth from '@crud/auth'

export const UserFilter = (props: Omit<EntityFilterProps, 'children'>) => {
  return (
    <EntityFilter {...props}>
      <Auth.UserSelect allowCreate={false} />
    </EntityFilter>
  )
}
