'use client'
import React from 'react'

import * as Media from '@crud/media'

const Page = () => {
  const { Form: GenreForm } = Media.useGenreForm({
    action: 'edit',
  })
  return <GenreForm />
}

export default Page
