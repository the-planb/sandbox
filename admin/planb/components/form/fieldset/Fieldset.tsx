import React, { type ReactNode } from 'react'
import css from './style.module.scss'
import classNames from 'classnames'
import { useErrorBag } from '@planb/components/form'

export interface FieldsetProps {
  legend: string
  id: string
  children?: ReactNode | ReactNode[]
}

export function Fieldset ({ id, legend, children }: FieldsetProps) {
  const { errorFieldsets } = useErrorBag()
  const error = errorFieldsets[id]

  const props = {
    className: classNames([
      css.fieldset,
      error ? 'error' : null
    ])
  }

  return <fieldset id={id} {...props}>
    <legend>{legend}</legend>
    <div className='field'>
      {children}
    </div>
  </fieldset>
}
