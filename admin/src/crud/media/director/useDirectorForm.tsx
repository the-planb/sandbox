import React from 'react'
import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import { FormAction, useTranslate } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'
import { FooterButtons, HeaderButtons, formCss } from '@planb/components'
import { FC } from 'react'
import * as Media from '@crud/media'

type useDirectorFormProps = UseFormProps<Media.Director> & {
  action: FormAction
}
type useDirectorFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useDirectorForm = (
  props: useDirectorFormProps,
): useDirectorFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Media.Director>({
      resource: 'media/directors',
      submitOnEnter: true,
      redirect: false,
      ...props,
    })

  const wrapperProps = {
    className: formCss.wrapper,
  }

  const footerButtonsProps = {
    form,
    onFinish,
    redirect,
    action: props.action,
    resource: 'media/directors',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'media/directors' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/directors'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.DirectorForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'media/directors' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'media/directors'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Media.DirectorForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }
  return {
    Form,
  }
}
