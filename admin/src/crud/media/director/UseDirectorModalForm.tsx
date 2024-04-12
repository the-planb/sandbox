import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import { BaseKey, FormAction } from '@refinedev/core'
import { FC } from 'react'
import { FormProps, Modal, Spin } from 'antd'
import React from 'react'
import * as Media from '@crud/media'

type useDirectorModalFormProps = UseFormProps<Media.Director> & {
  action: FormAction
}
type useDirectorModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useDirectorModalForm = (
  props: useDirectorModalFormProps,
): useDirectorModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<Media.Director>({
      resource: 'media/directors',
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
            <Media.DirectorForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
