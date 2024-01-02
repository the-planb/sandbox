'use client'

import { useGo, useTranslate } from '@refinedev/core'
import { Button } from 'antd'

export default function Dashboard() {
  const t = useTranslate()

  const go = useGo()

  return (
    <>
      <Button
        onClick={() => {
          go({
            to: {
              resource: 'bookstore/books',
              action: 'edit',
              id: '018ce93a-8ca1-2cd8-9668-f1c2e3fab5dc',
            },
          })
        }}>
        Dale
      </Button>
    </>
  )
}
