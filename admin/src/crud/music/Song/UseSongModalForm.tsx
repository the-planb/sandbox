import { UseFormProps, UseFormReturnType, useModalForm } from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as Music from '@crud/music'
import { BaseKey, FormAction } from '@refinedev/core'
import { FormProps, Modal, Spin } from 'antd'

type UseSongModalFormProps = UseFormProps<Music.Song> & { action: FormAction }
type UseSongModalFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useSongModalForm = (
  props: UseSongModalFormProps,
): UseSongModalFormReturnType => {
  const { show, modalProps, formProps, formLoading } = useModalForm<Music.Song>(
    {
      resource: 'music/songs',
      submitOnEnter: true,
      redirect: false,
      ...props,
    },
  )

  return {
    show,
    Form: () => {
      return (
        <Modal {...modalProps}>
          <Spin spinning={formLoading}>
            <Music.SongForm {...formProps} layout='vertical' />
          </Spin>
        </Modal>
      )
    },
  }
}
