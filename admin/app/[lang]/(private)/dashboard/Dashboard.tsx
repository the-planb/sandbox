'use client'

import { Button } from 'antd'
import fetchJson from '@planb/provider/ApiClient/fetchJson'
import { ApiUrl } from '@planb/provider'
import { useState } from 'react'

export default function Dashboard() {

  const [code, setCode] = useState<string>('')

  const handle = async () => {
    const url = ApiUrl('ClientMode')
    setCode('....')
    console.time('s')
    // await fetchJson(url, '/bookstore/books/018c3ac1-537a-d59b-1624-e36c2289327d')
    // const data = await fetchJson(url, '/bookstore/books/018c3ac1-537a-d59b-1624-e36c2289327d')

    await fetch('https://www.prueba.local/bookstore/books/')
    const data = await fetchJson(url, '/bookstore/books/')

    console.timeEnd('s')
    setCode(JSON.stringify(data, null, 4))

  }

  return (
    <>
      <Button onClick={handle}>Dale</Button>

      <code>
        <pre>
          {code}
        </pre>
      </code>
    </>
  )
}
