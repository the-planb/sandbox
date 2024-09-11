import React from 'react'
import {
  UseFormProps,
  UseFormReturnType,
  useDrawerForm,
  Create,
  Edit,
} from '@refinedev/antd'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import { FormProps, Drawer, Spin } from 'antd'
import { FC, useCallback } from 'react'
import * as Media from '@crud/media'

type useGenreDrawerFormProps = UseFormProps<Media.Genre> & {
  action: FormAction
}
type useGenreDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useGenreDrawerForm = (
  props: useGenreDrawerFormProps,
): useGenreDrawerFormReturnType => {
  const t = useTranslate()
  const { show, saveButtonProps, drawerProps, formProps, formLoading } =
    useDrawerForm<Media.Genre>({
      resource: 'media/genres',
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
              title={t('media/genres.titles.create')}
              width={800}>
              <Create
                isLoading={formLoading}
                saveButtonProps={{
                  ...saveButtonProps,
                  icon: false,
                }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Media.GenreForm {...formProps} layout='vertical' />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('media/genres.titles.edit')}
              width={800}>
              <Edit
                isLoading={formLoading}
                saveButtonProps={{
                  ...saveButtonProps,
                  icon: false,
                }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Media.GenreForm {...formProps} layout='vertical' />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
