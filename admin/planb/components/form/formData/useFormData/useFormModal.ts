import {
  type BaseKey,
  type BaseRecord,
  type FormAction,
  type HttpError,
} from '@refinedev/core'
import {
  useModalForm,
  type UseModalFormProps,
  type UseModalFormReturnType,
} from '@refinedev/antd'
import { type FormProps, type ModalProps } from 'antd'

export interface UseFormModalProps<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> extends Omit<UseModalFormProps, 'action'> {
  like: 'modal'
  resource: string
  action?: FormAction
  id?: BaseKey
  formProps?: FormProps
  modalProps?: ModalProps
}

export interface UseFormModalReturnType<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> extends UseModalFormReturnType {
  like: 'modal'
  id?: BaseKey
  action: FormAction
  resource: string
}

export const useFormDataModal = <
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
>({
  like,
  ...props
}: UseFormModalProps<TData, TError, TVariables>): UseFormModalReturnType<
  TData,
  TError,
  TVariables
> => {
  const {
    modalProps: modal,
    formProps: form,
    ...extra
  } = useModalForm(props as UseModalFormProps)

  const modalProps: ModalProps = {
    destroyOnClose: true,
    focusTriggerAfterClose: true,
    ...modal,
    ...props.modalProps,
    footer: false,
  }

  const formProps = {
    ...form,
    ...props.formProps,
  }

  return {
    like: 'modal',
    action: props.action as FormAction,
    resource: props.resource,
    formProps,
    modalProps: {
      ...modalProps,
    },
    ...extra,
  }
}
