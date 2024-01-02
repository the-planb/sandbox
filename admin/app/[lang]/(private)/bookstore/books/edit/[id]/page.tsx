'use client'

import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { Form: BookForm } = BookStore.useBookForm({
    action: 'edit',
  })
  return <BookForm />
}

export default Page
