import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import React, { FC } from 'react'
import * as BookStore from '@crud/bookstore'
import { FormAction, useTranslate } from '@refinedev/core'
import {
  formCss as css,
  FooterButtons,
  HeaderButtons,
  normalizeFormProps,
} from '@planb/components'
import { FormProps } from 'antd'

type UseTagFormProps = UseFormProps<BookStore.Tag> & { action: FormAction }
type UseTagFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useTagForm = (props: UseTagFormProps): UseTagFormReturnType => {
  const t = useTranslate()
  const {
    formProps: _formProps,
    formLoading,
    form,
    onFinish,
    redirect,
  } = useForm<BookStore.Tag>({
    resource: 'bookstore/tags',
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
    resource: 'bookstore/tags',
  }

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'bookstore/tags' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/tags'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.TagForm {...formProps} />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'bookstore/tags' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/tags'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.TagForm {...formProps} />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
