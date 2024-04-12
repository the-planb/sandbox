import { BaseRecord } from '@refinedev/core'
import React from 'react'
import * as Media from '@crud/media'

export interface Movie extends BaseRecord {
  '@id': string
  id: string
  title: Media.MovieTitle
  releaseYear: Media.ReleaseYear
  director: Media.Director
  reviews: Media.Review[]
  genres: Media.Genre[]
  overview: Media.Overview
}
