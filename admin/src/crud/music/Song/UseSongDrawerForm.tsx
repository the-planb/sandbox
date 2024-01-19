import {
  UseFormProps,
  UseFormReturnType,
  useDrawerForm,
  Create,
  Edit,
} from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Music from '@crud/music'
import { normalizeFormProps } from '@planb/components'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import { FormProps, Drawer, Spin } from 'antd'

type UseSongDrawerFormProps = UseFormProps<Music.Song> & { action: FormAction }
type UseSongDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useSongDrawerForm = (
  props: UseSongDrawerFormProps,
): UseSongDrawerFormReturnType => {
  const t = useTranslate()

  const {
    show,
    saveButtonProps,
    drawerProps,
    formProps: _formProps,
    formLoading,
  } = useDrawerForm<Music.Song>({
    resource: 'music/songs',
    submitOnEnter: true,
    redirect: false,
    ...props,
  })

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('music/songs.titles.create')}
              width={800}>
              <Create
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Music.SongForm {...formProps} />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('music/songs.titles.edit')}
              width={800}>
              <Edit
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Music.SongForm {...formProps} />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
