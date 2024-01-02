'use client'

import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { Form: AuthorForm } = BookStore.useAuthorForm({
    action: 'create',
  })
  return <AuthorForm />
}

export default Page
