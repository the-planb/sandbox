import { Space } from 'antd'
import { BaseRecord } from '@refinedev/core'

interface TableCellProps<T extends BaseRecord> {
  value: T | T[] | number | string
  renderer?: (value: any) => string
}

const defaultRenderer = <T extends BaseRecord>(value: T | string | number) => {
  let data = value as unknown as string

  if (typeof value !== 'object') {
    return <>{data}</>
  }

  return <>...</>
}

export const TableCell = <T extends BaseRecord>({
  value,
  renderer,
}: TableCellProps<T>) => {
  const custom = renderer || defaultRenderer<T>

  if (Array.isArray(value)) {
    return (
      <Space>
        {value.map((item) => {
          return custom(item)
        })}
      </Space>
    )
  }

  return <Space> {custom(value as T)} </Space>
}
