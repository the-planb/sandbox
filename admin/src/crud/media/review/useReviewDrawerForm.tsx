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

type useReviewDrawerFormProps = UseFormProps<Media.Review> & {
  action: FormAction
}
type useReviewDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useReviewDrawerForm = (
  props: useReviewDrawerFormProps,
): useReviewDrawerFormReturnType => {
  const t = useTranslate()
  const { show, saveButtonProps, drawerProps, formProps, formLoading } =
    useDrawerForm<Media.Review>({
      resource: 'media/reviews',
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
              title={t('media/reviews.titles.create')}
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
                <Media.ReviewForm {...formProps} layout='vertical' />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('media/reviews.titles.edit')}
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
                <Media.ReviewForm {...formProps} layout='vertical' />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
