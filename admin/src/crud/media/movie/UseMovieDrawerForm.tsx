import {
  UseFormProps,
  UseFormReturnType,
  useDrawerForm,
  Create,
  Edit,
} from '@refinedev/antd'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import { FC, useCallback } from 'react'
import { FormProps, Drawer, Spin } from 'antd'
import React from 'react'
import * as Media from '@crud/media'

type useMovieDrawerFormProps = UseFormProps<Media.Movie> & {
  action: FormAction
}
type useMovieDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useMovieDrawerForm = (
  props: useMovieDrawerFormProps,
): useMovieDrawerFormReturnType => {
  const t = useTranslate()
  const { show, saveButtonProps, drawerProps, formProps, formLoading } =
    useDrawerForm<Media.Movie>({
      resource: 'media/movies',
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
              title={t('media/movies.titles.create')}
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
                <Media.MovieForm {...formProps} layout='vertical' />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('media/movies.titles.edit')}
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
                <Media.MovieForm {...formProps} layout='vertical' />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
