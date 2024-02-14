import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Staff from '@crud/staff'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseUserModalFormProps = UseFormProps<Staff.User> & { action: FormAction }
type UseUserModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useUserModalForm = (
  props: UseUserModalFormProps,
): UseUserModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } = useModalForm<Staff.User>(
    {
      resource: 'staff/users',
      submitOnEnter: true,
      redirect: false,
      ...props,
    },
  )

  return {
    show,
    Form: () => {
      return (
        <Modal {...modalProps}>
          <Spin spinning={formLoading}>
            <Staff.UserForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
