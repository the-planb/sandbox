'use client'
import React from 'react'

import * as Media from '@crud/media'

const Page = () => {
  const { Form: DirectorForm } = Media.useDirectorForm({
    action: 'create',
  })
  return
  ;<DirectorForm />
}

export default Page
