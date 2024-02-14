import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import React, { FC } from 'react'
import * as Staff from '@crud/staff'
import { FormAction, useTranslate } from '@refinedev/core'
import { formCss as css, FooterButtons, HeaderButtons } from '@planb/components'
import { FormProps } from 'antd'

type UseUserFormProps = UseFormProps<Staff.User> & { action: FormAction }
type UseUserFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useUserForm = (props: UseUserFormProps): UseUserFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Staff.User>({
      resource: 'staff/users',
      submitOnEnter: true,
      redirect: false,
      ...props,
    })

  const wrapperProps = {
    className: css.wrapper,
  }

  const footerButtonsProps = {
    form,
    onFinish,
    redirect,
    action: props.action,
    resource: 'staff/users',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'staff/users' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'staff/users'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Staff.UserForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'staff/users' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'staff/users'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Staff.UserForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
