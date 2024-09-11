import React from 'react'
import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'
import { FC } from 'react'
import * as Media from '@crud/media'

type useGenreModalFormProps = UseFormProps<Media.Genre> & { action: FormAction }
type useGenreModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useGenreModalForm = (
  props: useGenreModalFormProps,
): useGenreModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<Media.Genre>({
      resource: 'media/genres',
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
            <Media.GenreForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
