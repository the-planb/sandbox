import classNames from 'classnames'
import css from './style.module.scss'
import { Create, Edit, ListButton, RefreshButton } from '@refinedev/antd'
import { SingleForm, type SingleFormProps } from '@planb/components/form/formData/SingleForm'
import React from 'react'
import { type WithChildren } from '@planb/components/form/formData/types'
import { useFormContext } from '@planb/components/form/formData/useFormContext'
import { useErrorBag } from '@planb/components/form'
import { ActionButtons } from '@planb/components/form/formData/ActionButtons'
import { ArrowLeftOutlined } from '@ant-design/icons'
import { UseFormPageReturnType } from '@planb/components/form/formData/useFormData/useFormPage'

export type PageFormProps = Omit<UseFormPageReturnType, 'like'> & WithChildren

export function PageForm({
                           action,
                           resource,
                           saveButtonProps: saveButton,
                           ...props
                         }: PageFormProps) {
  const { isValid } = useErrorBag()
  const { like } = useFormContext()

  const wrapperProps = {
    className: classNames(css.formPage, like),
  }

  const extra = like === 'view' ?
    {
      headerButtons: <>
        <ListButton icon={<ArrowLeftOutlined />} />
        <RefreshButton />
      </>,
      footerButtons: <ActionButtons form={props.form}
                                    redirect={props.redirect}
                                    onFinish={props.onFinish}
                                    disabled={!isValid} />,
    } :
    {
      headerButtons: <></>,
      saveButtonProps: {
        ...saveButton,
        icon: null,
        disabled: !isValid,
      },
      deleteButtonProps: {
        icon: null,
      },
    }

  if (action === 'create') {
    return (
      <Create
        resource={resource}
        goBack={false}
        breadcrumb={false}
        wrapperProps={wrapperProps}
        {...extra}
      >
        <SingleForm {...(props as SingleFormProps)} />
      </Create>
    )
  }
  return (
    <Edit
      resource={resource}
      goBack={false}
      breadcrumb={false}
      wrapperProps={wrapperProps}
      {...extra}
    >
      <SingleForm {...(props as SingleFormProps)} />
    </Edit>
  )
}
