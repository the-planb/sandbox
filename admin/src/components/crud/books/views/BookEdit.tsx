'use client'

import { useFormData } from '@planb/components/form'
import { BookForm } from '@components/crud/books'

export function BookEdit () {
  const { ...props } = useFormData({
    resource: 'bookstore/books',
    action: 'edit'
  })

  return <BookForm {...props} />
}
