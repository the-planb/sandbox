import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as BookStore from '@crud/bookstore'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseBookModalFormProps = UseFormProps<BookStore.Book> & {
  action: FormAction
}
type UseBookModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useBookModalForm = (
  props: UseBookModalFormProps,
): UseBookModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<BookStore.Book>({
      resource: 'bookstore/books',
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
            <BookStore.BookForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
