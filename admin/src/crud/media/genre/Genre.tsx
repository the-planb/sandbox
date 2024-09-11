import React from 'react'
import { BaseRecord } from '@refinedev/core'
import * as Media from '@crud/media'

export interface Genre extends BaseRecord {
  '@id': string
  id: string
  name: Media.GenreName
}
