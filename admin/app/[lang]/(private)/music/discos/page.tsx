'use client'

import * as Music from '@crud/music'
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
  } = Music.useDiscoTable()

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
