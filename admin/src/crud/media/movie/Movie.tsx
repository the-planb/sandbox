import React from 'react'
import { BaseRecord } from '@refinedev/core'
import * as Media from '@crud/media'

export interface Movie extends BaseRecord {
  '@id': string
  id: string
  title: Media.MovieTitle
  releaseYear: Media.ReleaseYear
  director: Media.Director
  overview: Media.Overview
}
