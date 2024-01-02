import { BaseKey, BaseRecord, FormAction } from '@refinedev/core'
import { UseFormProps, UseFormReturnType } from '@refinedev/antd'
import { FC } from 'react'

type UseFormFunctionProps<TData extends BaseRecord> = UseFormProps<TData> & {
  action: FormAction
}
type UseFormFunctionReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export type UseFormFunction<TData extends BaseRecord> = (
  props: UseFormFunctionProps<TData>,
) => UseFormFunctionReturnType
