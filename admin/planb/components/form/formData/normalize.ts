import { Store } from 'rc-field-form/es/interface'
import { FormProps } from 'antd'

const normalize = (value: any): any => {
  if (Array.isArray(value)) {
    return value.map(normalize)
  }

  if (typeof value === 'object' && '@id' in value) {
    return value['@id']
  }

  return value
}

const normalizeValues = (store: Store | undefined): Store | undefined => {
  if (store === undefined) {
    return store
  }

  const values: Store = {}
  for (const key in store) {
    values[key] = normalize(store[key])
  }

  return values
}

export const normalizeFormProps = ({
  initialValues,
  ...props
}: FormProps): FormProps => {
  return {
    layout: 'vertical',
    ...props,
    initialValues: normalizeValues(initialValues),
  }
}
