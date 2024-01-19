'use client'

import * as Music from '@crud/music'

const Page = () => {
  const { Form: DiscoForm } = Music.useDiscoForm({
    action: 'create',
  })
  return <DiscoForm />
}

export default Page
