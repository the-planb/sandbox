import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import { FC } from 'react'
import { FormAction, useTranslate } from '@refinedev/core'

import { FooterButtons, HeaderButtons, formCss as css } from '@planb/components'

import React from 'react'
import * as Media from '@crud/media'

type useGenreFormProps = UseFormProps<Media.Genre> & { action: FormAction }
type useGenreFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useGenreForm = (
  props: useGenreFormProps,
): useGenreFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Media.Genre>({
      resource: 'media/genres',
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
    resource: 'media/genres',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'media/genres' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/genres'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.GenreForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'media/genres' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/genres'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.GenreForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }
  return {
    Form,
  }
}
