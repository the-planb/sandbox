import React from 'react'

import * as Media from '@crud/media'

export const fullNameRenderer = (fullName: Media.FullName): string => {
  return `${fullName.name} ${fullName.lastName}`
}
