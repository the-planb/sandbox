import { type BaseKey, type BaseRecord, type FormAction, type HttpError } from '@refinedev/core'
import { useForm, type UseFormProps, type UseFormReturnType } from '@refinedev/antd'
import { type FormProps } from 'antd'

export interface UseFormPageProps<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> extends UseFormProps {
  like?: undefined | 'view'
  resource: string
  action?: FormAction
  id?: BaseKey
  formProps?: FormProps
}

export interface UseFormPageReturnType<
  TData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TVariables = {},
  TSelectData extends BaseRecord = TData,
> extends UseFormReturnType {
  like: 'view'
  id?: BaseKey
  action?: FormAction
  resource: string
  show: () => void
}

const FakeShow = (): void => {

}
export const useFormDataPage =
  <TData extends BaseRecord = BaseRecord, TError extends HttpError = HttpError, TVariables = {}, TSelectData extends BaseRecord = TData>
  ({ like, ...props }: UseFormPageProps<TData, TError, TVariables>): UseFormPageReturnType<TData, TError, TVariables> => {
    return {
      like: 'view',
      action: props.action,
      resource: props.resource,
      show: () => FakeShow,
      ...useForm(props)
    }
  }
