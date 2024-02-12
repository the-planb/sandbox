import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Auth from '@crud/auth'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseUserModalFormProps = UseFormProps<Auth.User> & { action: FormAction }
type UseUserModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useUserModalForm = (
  props: UseUserModalFormProps,
): UseUserModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } = useModalForm<Auth.User>({
    resource: 'auth/users',
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
            <Auth.UserForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
