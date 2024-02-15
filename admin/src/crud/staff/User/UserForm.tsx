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

import * as Staff from '@crud/staff'

const Main = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset legend={t('fieldsets.data', { ns: 'staff/users' })} id={'data'}>
        <Staff.UserNameInput
          required={true}
          label={t('fields.name.label', { ns: 'staff/users' })}
          name={'name'}
        />
        <Staff.EmailInput
          required={true}
          label={t('fields.email.label', { ns: 'staff/users' })}
          name={'email'}
        />
        <Staff.RoleListInput
          required={true}
          label={t('fields.roles.label', { ns: 'staff/users' })}
          name={'roles'}
        />
        <Staff.PasswordInput
          required={true}
          label={t('fields.password.label', { ns: 'staff/users' })}
          name={'password'}
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
            label: t('tabs.main', { ns: 'staff/users' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
