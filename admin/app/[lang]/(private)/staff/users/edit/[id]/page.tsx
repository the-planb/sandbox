'use client'

import * as Staff from '@crud/staff'

const Page = () => {
  const { Form: UserForm } = Staff.useUserForm({
    action: 'edit',
  })
  return <UserForm />
}

export default Page
