import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import React, { FC } from 'react'
import * as Music from '@crud/music'
import { FormAction, useTranslate } from '@refinedev/core'
import { formCss as css, FooterButtons, HeaderButtons } from '@planb/components'
import { FormProps } from 'antd'

type UseSongFormProps = UseFormProps<Music.Song> & { action: FormAction }
type UseSongFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useSongForm = (props: UseSongFormProps): UseSongFormReturnType => {
  const t = useTranslate()
  const { formProps, formLoading, form, onFinish, redirect } =
    useForm<Music.Song>({
      resource: 'music/songs',
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
    resource: 'music/songs',
  }

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'music/songs' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'music/songs'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Music.SongForm {...formProps} layout='vertical' />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'music/songs' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'music/songs'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Music.SongForm {...formProps} layout='vertical' />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
