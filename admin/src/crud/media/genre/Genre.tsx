import { BaseRecord } from '@refinedev/core'
import React from 'react'
import * as Media from '@crud/media'

export interface Genre extends BaseRecord {
  '@id': string
  id: string
  name: Media.GenreName
  movies: Media.Movie[]
}
