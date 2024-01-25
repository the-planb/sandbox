import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Music from '@crud/music'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseDiscoModalFormProps = UseFormProps<Music.Disco> & { action: FormAction }
type UseDiscoModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useDiscoModalForm = (
  props: UseDiscoModalFormProps,
): UseDiscoModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } =
    useModalForm<Music.Disco>({
      resource: 'music/discos',
      submitOnEnter: true,
      redirect: false,
      ...props,
    })

  return {
    show,
    Form: () => {
      return (
        <Modal {...modalProps}>
          <Spin spinning={formLoading}>
            <Music.DiscoForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
