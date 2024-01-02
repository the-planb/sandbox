import { Button, ButtonProps, SelectProps } from 'antd'
import { BaseRecord, CreateResponse, UpdateResponse } from '@refinedev/core'
import { DefaultOptionType } from 'rc-select/es/Select'
import { UseFormFunction } from '@planb/components'

type CreateEntityButtonProps<TData extends BaseRecord> = Omit<
  ButtonProps,
  'onChange'
> & {
  itemToOption: (item: TData) => DefaultOptionType
  useCreateForm: UseFormFunction<TData>
  value?: string | string[]
  setValue: (value: string | string[]) => void
  onChange?:
    | ((value: any, option: DefaultOptionType | DefaultOptionType[]) => void)
    | undefined
  mode: SelectProps['mode']
}

export const CreateEntityButton = <TData extends BaseRecord>({
  children,
  itemToOption,
  useCreateForm,
  value,
  setValue,
  onChange,
  mode,
}: CreateEntityButtonProps<TData>) => {
  const onMutationSuccess = (
    response: UpdateResponse<TData> | CreateResponse<TData>,
  ) => {
    if (!onChange) {
      return
    }

    let data: string | string[] = response.data['@id']
    let option: DefaultOptionType | DefaultOptionType[] = itemToOption(
      response.data as unknown as TData,
    )

    if (['multiple', 'tags'].includes(mode as string)) {
      data = [...(value as string[]), response.data['@id']]
      option = itemToOption(response.data as unknown as TData)
    }

    setValue(data)
    onChange(data, option)
  }

  const { show, Form } = useCreateForm({
    action: 'create',
    onMutationSuccess,
  })

  return (
    <>
      <Button type={'link'} style={{ paddingLeft: 0 }} onClick={() => show()}>
        {children}
      </Button>
      <Form />
    </>
  )
}
