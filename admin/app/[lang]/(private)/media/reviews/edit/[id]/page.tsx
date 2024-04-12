'use client'
import React from 'react'
import * as Media from '@crud/media'

const Page = () => {
  const { Form: ReviewForm } = Media.useReviewForm({
    action: 'edit',
  })
  return <ReviewForm />
}

export default Page
