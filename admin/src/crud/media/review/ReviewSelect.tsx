import { type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import React from 'react'
import * as Media from '@crud/media'

type ReviewSelectProps = SelectProps & { allowCreate?: boolean }

export const ReviewSelect = ({
  allowCreate = true,
  value,
  ...props
}: ReviewSelectProps) => {
  const itemToOption = (review: Media.Review) => ({
    label: Media.reviewRenderer(review),
    value: review['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'media/reviews'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Media.useReviewModalForm : undefined}
    />
  )
}
