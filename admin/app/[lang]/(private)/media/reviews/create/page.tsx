'use client'
import React from 'react'
import * as Media from '@crud/media'

const Page = () => {
  const { Form: ReviewForm } = Media.useReviewForm({
    action: 'create',
  })
  return <ReviewForm />
}

export default Page
