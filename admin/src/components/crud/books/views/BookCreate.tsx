'use client'

import { useFormData } from '@planb/components/form'
import { BookForm } from '@components/crud/books'

export function BookCreate() {
  const { ...props } = useFormData({
    resource: 'bookstore/books',
    action: 'create',
  })

  return <BookForm {...props} />
}
