import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as BookStore from '@crud/bookstore'
import { normalizeFormProps } from '@planb/components'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseAuthorModalFormProps = UseFormProps<BookStore.Author> & {
  action: FormAction
}
type UseAuthorModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useAuthorModalForm = (
  props: UseAuthorModalFormProps,
): UseAuthorModalFormReturnType => {
  const {
    show,
    modalProps,
    formProps: _formProps,
    formLoading,
  } = useModalForm<BookStore.Author>({
    resource: 'bookstore/authors',
    submitOnEnter: true,
    redirect: false,
    ...props,
  })

  const formProps: FormProps = normalizeFormProps(_formProps)

  return {
    show,
    Form: () => {
      return (
        <Modal {...modalProps}>
          <Spin spinning={formLoading}>
            <BookStore.AuthorForm {...formProps} />
          </Spin>
        </Modal>
      )
    },
  }
}
