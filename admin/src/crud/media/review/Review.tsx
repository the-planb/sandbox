import React from 'react'
import { BaseRecord } from '@refinedev/core'
import * as Media from '@crud/media'

export interface Review extends BaseRecord {
  '@id': string
  id: string
  review: Media.ReviewContent
  score: Media.Score
  movie: Media.Movie
}
