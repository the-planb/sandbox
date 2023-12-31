import React from 'react'
import { type FormAction } from '@refinedev/core'
import { type UseFormDataReturnType } from './useFormData'
import { type WithChildren } from './types'
import { PageForm, type PageFormProps } from './PageForm'
import { createErrorBag, ErrorBagContext } from './useErrorBag'
import { ModalForm, type ModalFormProps } from './ModalForm'
import { DrawerForm, type DrawerFormProps } from './DrawerForm'
import { FormContext } from './useFormContext'

export type FormDataProps = Omit<UseFormDataReturnType, 'show'>

export function FormData({
  like,
  children,
  ...props
}: FormDataProps & WithChildren) {
  const errorBag = createErrorBag(children)
  const { form } = props

  return (
    <FormContext.Provider
      value={{
        action: props.action as FormAction,
        like: like ?? 'view',
      }}>
      <ErrorBagContext.Provider value={errorBag}>
        {like === 'modal' && (
          <ModalForm {...(props as ModalFormProps)}>{children}</ModalForm>
        )}
        {like === 'drawer' && (
          <DrawerForm {...(props as DrawerFormProps)}>{children}</DrawerForm>
        )}
        {(like === 'view' || like === undefined) && (
          <PageForm {...(props as PageFormProps)}>{children}</PageForm>
        )}
      </ErrorBagContext.Provider>
    </FormContext.Provider>
  )
}
