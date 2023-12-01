'use client'

import * as BookStore from '@crud/bookstore'
import { useFormData } from '@planb/components/form'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/books',
    action: 'create',
  })

  return <BookStore.BookForm {...props} />
}

export default Page
