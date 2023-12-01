'use client'

import * as BookStore from '@crud/bookstore'
import { useFormData } from '@planb/components/form'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/authors',
    action: 'create',
  })

  return <BookStore.AuthorForm {...props} />
}

export default Page
