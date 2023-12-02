'use client'

import * as BookStore from '@crud/bookstore'
import { useFormData } from '@planb/components/form'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/tags',
    action: 'create',
  })

  return <BookStore.TagForm {...props} />
}

export default Page
