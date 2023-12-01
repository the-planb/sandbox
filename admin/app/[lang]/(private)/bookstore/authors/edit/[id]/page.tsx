'use client'

import { useFormData } from '@planb/components/form'
import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { ...props } = useFormData({
    resource: 'bookstore/authors',
    action: 'edit',
  })

  return <BookStore.AuthorForm {...props} />
}

export default Page
