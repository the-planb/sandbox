'use client'

import * as BookStore from '@crud/bookstore'
import { List } from '@refinedev/antd'
import { Flex, Table } from 'antd'
import { SearchForm } from '@planb/components/datagrid'

const Page = () => {
  const {
    listProps,
    flexProps,
    searchProps,
    tableProps,
    hasFilters,
    EditForm,
    CreateForm,
  } = BookStore.useTagTable()

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
