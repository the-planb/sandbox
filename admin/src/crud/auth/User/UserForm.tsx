'use client'
import React from 'react'
import {
  Col,
  Form,
  FormProps,
  Input,
  InputNumber,
  Row,
  Space,
  Tabs,
} from 'antd'
import { Fieldset, FormData, Toc } from '@planb/components/form'
import { useTranslate } from '@refinedev/core'

import * as Auth from '@crud/auth'

const Main = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset legend={t('fieldsets.data', { ns: 'auth/users' })} id={'data'}>
        <Auth.UserNameInput
          required={true}
          label={t('fields.name.label', { ns: 'auth/users' })}
          name={'name'}
        />
        <Auth.EmailInput
          required={true}
          label={t('fields.email.label', { ns: 'auth/users' })}
          name={'email'}
        />
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function UserForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'auth/users' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
