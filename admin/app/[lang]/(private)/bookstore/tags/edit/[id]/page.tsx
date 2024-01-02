'use client'

import * as BookStore from '@crud/bookstore'

const Page = () => {
  const { Form: TagForm } = BookStore.useTagForm({
    action: 'edit',
  })
  return <TagForm />
}

export default Page
