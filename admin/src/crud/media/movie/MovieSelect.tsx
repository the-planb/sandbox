import React from 'react'
import { type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Media from '@crud/media'

type MovieSelectProps = SelectProps & { allowCreate?: boolean }

export const MovieSelect = ({
  allowCreate = true,
  value,
  ...props
}: MovieSelectProps) => {
  const itemToOption = (movie: Media.Movie) => ({
    label: Media.movieRenderer(movie),
    value: movie['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'media/movies'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Media.useMovieModalForm : undefined}
    />
  )
}
