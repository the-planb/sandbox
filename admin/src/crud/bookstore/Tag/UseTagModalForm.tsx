import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as BookStore from '@crud/bookstore'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseTagModalFormProps = UseFormProps<BookStore.Tag> & { action: FormAction }
type UseTagModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useTagModalForm = (
  props: UseTagModalFormProps,
): UseTagModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<BookStore.Tag>({
      resource: 'bookstore/tags',
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
            <BookStore.TagForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
