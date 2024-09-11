import React from 'react'
import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'
import { FC } from 'react'
import * as Media from '@crud/media'

type useMovieModalFormProps = UseFormProps<Media.Movie> & { action: FormAction }
type useMovieModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useMovieModalForm = (
  props: useMovieModalFormProps,
): useMovieModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<Media.Movie>({
      resource: 'media/movies',
      submitOnEnter: true,
      redirect: false,
      ...props,
    })

  return {
    show,
    Form: () => {
      return (
        <Modal {...modalProps}>
          <Spin spinning={formLoading}>
            <Media.MovieForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
