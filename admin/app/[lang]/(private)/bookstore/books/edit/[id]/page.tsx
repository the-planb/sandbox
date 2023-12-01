'use client'

import { useFormData } from '@planb/components/form'
import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/books',
    action: 'edit',
  })

  return <BookStore.BookForm {...props} />
}

export default Page
