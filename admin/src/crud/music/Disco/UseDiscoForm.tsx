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
import {
  formCss as css,
  FooterButtons,
  HeaderButtons,
  normalizeFormProps,
} from '@planb/components'
import { FormProps } from 'antd'

type UseDiscoFormProps = UseFormProps<Music.Disco> & { action: FormAction }
type UseDiscoFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useDiscoForm = (
  props: UseDiscoFormProps,
): UseDiscoFormReturnType => {
  const t = useTranslate()
  const {
    formProps: _formProps,
    formLoading,
    form,
    onFinish,
    redirect,
  } = useForm<Music.Disco>({
    resource: 'music/discos',
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
    resource: 'music/discos',
  }

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'music/discos' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'music/discos'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Music.DiscoForm {...formProps} />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'music/discos' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'music/discos'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <Music.DiscoForm {...formProps} />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
