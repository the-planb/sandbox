'use client'
import React from 'react'

import * as Media from '@crud/media'

const Page = () => {
  const { Form: GenreForm } = Media.useGenreForm({
    action: 'create',
  })
  return
  ;<GenreForm />
}

export default Page
