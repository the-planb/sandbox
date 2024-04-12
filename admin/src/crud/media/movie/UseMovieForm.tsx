import {
  Create,
  Edit,
  SaveButton,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import { FC } from 'react'
import { FormAction, useTranslate } from '@refinedev/core'

import { FooterButtons, HeaderButtons, formCss as css } from '@planb/components'

import React from 'react'
import * as Media from '@crud/media'

type useMovieFormProps = UseFormProps<Media.Movie> & { action: FormAction }
type useMovieFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useMovieForm = (
  props: useMovieFormProps,
): useMovieFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Media.Movie>({
      resource: 'media/movies',
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
    resource: 'media/movies',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                resource={'media/movies'}
                title={t('titles.create', { ns: 'media/movies' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/movies'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.MovieForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'media/movies' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/movies'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.MovieForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }
  return {
    Form,
  }
}
