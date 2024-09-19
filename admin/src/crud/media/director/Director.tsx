import React from 'react'
import { BaseRecord } from '@refinedev/core'
import * as Media from '@crud/media'

export interface Director extends BaseRecord {
  '@id': string
  id: string
  name: Media.FullName
  movies: Media.Movie[]
}
