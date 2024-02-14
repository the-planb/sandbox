import {
  UseFormProps,
  UseFormReturnType,
  useDrawerForm,
  Create,
  Edit,
} from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Staff from '@crud/staff'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import { FormProps, Drawer, Spin } from 'antd'

type UseUserDrawerFormProps = UseFormProps<Staff.User> & { action: FormAction }
type UseUserDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useUserDrawerForm = (
  props: UseUserDrawerFormProps,
): UseUserDrawerFormReturnType => {
  const t = useTranslate()

  const { show, saveButtonProps, drawerProps, formProps, formLoading } =
    useDrawerForm<Staff.User>({
      resource: 'staff/users',
      submitOnEnter: true,
      redirect: false,
      ...props,
    })

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('staff/users.titles.create')}
              width={800}>
              <Create
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Staff.UserForm {...formProps} layout='vertical' />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('staff/users.titles.edit')}
              width={800}>
              <Edit
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Staff.UserForm {...formProps} layout='vertical' />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
