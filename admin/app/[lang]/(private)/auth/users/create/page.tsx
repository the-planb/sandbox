'use client'

import * as Auth from '@crud/auth'

const Page = () => {
  const { Form: UserForm } = Auth.useUserForm({
    action: 'create',
  })
  return <UserForm />
}

export default Page
