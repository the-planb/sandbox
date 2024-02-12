import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import React, { FC } from 'react'
import * as Auth from '@crud/auth'
import { FormAction, useTranslate } from '@refinedev/core'
import { formCss as css, FooterButtons, HeaderButtons } from '@planb/components'
import { FormProps } from 'antd'

type UseUserFormProps = UseFormProps<Auth.User> & { action: FormAction }
type UseUserFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useUserForm = (props: UseUserFormProps): UseUserFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Auth.User>({
      resource: 'auth/users',
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
    resource: 'auth/users',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'auth/users' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'auth/users'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Auth.UserForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'auth/users' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'auth/users'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Auth.UserForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
