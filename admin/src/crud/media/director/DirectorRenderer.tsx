import React from 'react'
import * as Media from '@crud/media'

export const directorRenderer = (director: Media.Director): string => {
  return director.name
}
