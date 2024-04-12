'use client'
import { List } from '@refinedev/antd'
import { Flex, Table } from 'antd'
import { SearchForm } from '@planb/components'

import React from 'react'
import * as Media from '@crud/media'

const Page = () => {
  const {
    listProps,
    flexProps,
    searchProps,
    tableProps,
    hasFilters,
    EditForm,
    CreateForm,
  } = Media.useGenreTable()
  return (
    <List {...listProps}>
      <Flex {...flexProps}>
        {hasFilters && <SearchForm {...searchProps} />}
        <Table {...tableProps} />
      </Flex>
      <EditForm />
      <CreateForm />
    </List>
  )
}
export default Page
