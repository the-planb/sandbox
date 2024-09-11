import React from 'react'
import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'
import { FC } from 'react'
import * as Media from '@crud/media'

type useReviewModalFormProps = UseFormProps<Media.Review> & {
  action: FormAction
}
type useReviewModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useReviewModalForm = (
  props: useReviewModalFormProps,
): useReviewModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<Media.Review>({
      resource: 'media/reviews',
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
            <Media.ReviewForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
