import { type BaseRecord, type FormAction, type HttpError, useResource } from '@refinedev/core'
import { useFormDataModal, type UseFormModalProps, type UseFormModalReturnType } from './useFormModal'
import { useFormDataDrawer, type UseFormDrawerProps, type UseFormDrawerReturnType } from './useFormDrawer'
import { useFormDataPage, type UseFormPageProps, type UseFormPageReturnType } from './useFormPage'

type UseFormDataProps<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> = UseFormPageProps<TData, TError, TVariables, TSelectData>
| UseFormModalProps<TData, TError, TVariables, TSelectData>
| UseFormDrawerProps<TData, TError, TVariables, TSelectData>

export type UseFormDataReturnType<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> = UseFormPageReturnType<TData, TError, TVariables, TSelectData>
| UseFormModalReturnType<TData, TError, TVariables, TSelectData>
| UseFormDrawerReturnType<TData, TError, TVariables, TSelectData>

export const useFormData =
  <TData extends BaseRecord = BaseRecord, TError extends HttpError = HttpError, TVariables = {}, TSelectData extends BaseRecord = TData>
  ({ ...props }: UseFormDataProps<TData, TError, TVariables, TSelectData>): UseFormDataReturnType<TData, TError, TVariables, TSelectData> => {
    props = props ?? {}
    const { action, id } = useResource()
    const { like } = props

    props = {
      ...props,
      action: props.action ?? (action as FormAction),
      id: props.id ?? id
    }

    if (like === 'modal') {
      return useFormDataModal({
        redirect: false,
        autoSubmitClose: true,
        ...props
      }
      )
    }

    if (like === 'drawer') {
      return useFormDataDrawer({
        redirect: false,
        autoSubmitClose: true,
        ...props
      })
    }

    return useFormDataPage(props)
  }
