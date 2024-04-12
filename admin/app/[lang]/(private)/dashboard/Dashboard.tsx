'use client'
import { useState } from 'react'

import { Editor } from '@planb/components/fields'

export default function Dashboard() {
  const [value, setValue] = useState('**Hello world!!!**')

  // return <></>
  return <Editor />
}
