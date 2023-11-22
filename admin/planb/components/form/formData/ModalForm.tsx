import { type UseFormModalReturnType } from '@planb/components/form/formData/useFormData/useFormModal'
import { type WithChildren } from '@planb/components/form/formData/types'
import { Modal } from 'antd'
import css from './style.module.scss'
import { SingleForm, type SingleFormProps } from '@planb/components/form/formData/SingleForm'
import React from 'react'
import { useErrorBag } from '@planb/components/form'

export type ModalFormProps = UseFormModalReturnType & WithChildren

export function ModalForm ({ modalProps, ...props }: ModalFormProps) {
  const { isValid } = useErrorBag()

  return <Modal {...modalProps} className={css.modalForm} okButtonProps={{
    disabled: !isValid
  }}>
    <SingleForm {...props as SingleFormProps}/>
  </Modal>
}
