import { useErrorBag } from '@planb/components/form/formData/useErrorBag'
import { type FieldData } from 'rc-field-form/es/interface'
import { Button, Form, type FormProps } from 'antd'
import React, { type ReactNode } from 'react'
import { type WithChildren } from '@planb/components/form/formData/types'
import css from './style.module.scss'

export type SingleFormProps = { formProps: FormProps } & WithChildren

export function SingleForm({ children, formProps }: SingleFormProps) {
  const errorBag = useErrorBag()
  const onFieldsChange = (_: FieldData[], allFields: FieldData[]) => {
    errorBag.update(allFields)
  }

  return (
    <Form
      layout={'vertical'}
      className={css.formData}
      validateTrigger={['onBlur', 'onChange']}
      onFieldsChange={onFieldsChange}
      {...formProps}>
      {children as ReactNode}
    </Form>
  )
}
