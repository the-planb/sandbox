interface TableCellProps {
  value: object | number | string
}

export const TableCell = ({ value }: TableCellProps) => {
  let data = value as unknown as string
  if (typeof value !== 'object') {
    return <>{data}</>
  }

  if ('@type' in value) {
    const name = value['@type'] as string
    return (
      <>
        <strong>TODO:</strong> <em>{name} to string</em>
      </>
    )
  }

  return <>...</>
}
