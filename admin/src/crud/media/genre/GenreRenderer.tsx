import React from 'react'
import * as Media from '@crud/media'

export const genreRenderer = (genre: Media.Genre): string => {
  return genre.name
}
