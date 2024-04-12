'use client'
import React from 'react'
import * as Media from '@crud/media'

const Page = () => {
  const { Form: MovieForm } = Media.useMovieForm({
    action: 'create',
  })
  return <MovieForm />
}

export default Page
