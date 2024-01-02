import React, { ReactNode } from 'react'
import { createErrorBag, ErrorBagContext } from './useErrorBag'
import { Form, FormProps } from 'antd'
import css from './style.module.scss'
import { FieldData } from 'rc-field-form/es/interface'

export function FormData({ children, ...props }: FormProps) {
  const errorBag = createErrorBag(children)
  const onFieldsChange = (field: FieldData[], allFields: FieldData[]) => {
    errorBag.validate(allFields)
  }

  return (
    <ErrorBagContext.Provider value={errorBag}>
      <Form className={css.formData} onFieldsChange={onFieldsChange} {...props}>
        {children as ReactNode}
      </Form>
    </ErrorBagContext.Provider>
  )
}
