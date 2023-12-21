'use client'

import { useEffect, useMemo, useState } from 'react'
import { Button } from 'antd'
import { AuthorInput } from '@crud/bookstore'

function delay(ms: number) {
  return new Promise(resolve => setTimeout(resolve, ms))
}



export default function Dashboard() {
  const [prop, setProp] = useState<number>(0)

  return <>

    <AuthorInput />
    <hr />

  </>

}
