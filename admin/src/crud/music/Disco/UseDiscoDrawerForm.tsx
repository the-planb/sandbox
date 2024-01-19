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

type UseDiscoDrawerFormProps = UseFormProps<Music.Disco> & {
  action: FormAction
}
type UseDiscoDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useDiscoDrawerForm = (
  props: UseDiscoDrawerFormProps,
): UseDiscoDrawerFormReturnType => {
  const t = useTranslate()

  const {
    show,
    saveButtonProps,
    drawerProps,
    formProps: _formProps,
    formLoading,
  } = useDrawerForm<Music.Disco>({
    resource: 'music/discos',
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
              title={t('music/discos.titles.create')}
              width={800}>
              <Create
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Music.DiscoForm {...formProps} />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('music/discos.titles.edit')}
              width={800}>
              <Edit
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <Music.DiscoForm {...formProps} />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
