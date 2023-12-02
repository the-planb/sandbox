'use client'

import { useFormData } from '@planb/components/form'
import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/tags',
    action: 'edit',
  })

  return <BookStore.TagForm {...props} />
}

export default Page
