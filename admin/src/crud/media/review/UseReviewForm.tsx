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

type useReviewFormProps = UseFormProps<Media.Review> & { action: FormAction }
type useReviewFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useReviewForm = (
  props: useReviewFormProps,
): useReviewFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Media.Review>({
      resource: 'media/reviews',
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
    resource: 'media/reviews',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'media/reviews' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/reviews'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.ReviewForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'media/reviews' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/reviews'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.ReviewForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }
  return {
    Form,
  }
}
