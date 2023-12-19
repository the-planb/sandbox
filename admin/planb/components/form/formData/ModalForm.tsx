import { type UseFormModalReturnType } from '@planb/components/form/formData/useFormData/useFormModal'
import { type WithChildren } from '@planb/components/form/formData/types'
import { Modal } from 'antd'
import css from './style.module.scss'
import React from 'react'
import { useErrorBag } from '@planb/components/form'
import {
  PageForm,
  PageFormProps,
} from '@planb/components/form/formData/PageForm'

export type ModalFormProps = UseFormModalReturnType & WithChildren

export function ModalForm({ modalProps, ...props }: ModalFormProps) {
  const { isValid } = useErrorBag()

  return (
    <Modal
      {...modalProps}
      title={null}
      className={css.modalForm}
      okButtonProps={{
        disabled: !isValid,
      }}>
      <PageForm {...(props as unknown as PageFormProps)} />
    </Modal>
  )
}
