'use client'
import React from 'react'
import { Col, Form, Input, InputNumber, Row, Tabs } from 'antd'
import {
  Fieldset,
  FormData,
  type FormDataProps,
  Toc,
} from '@planb/components/form'
import { useTranslate } from '@refinedev/core'

import * as BookStore from '@crud/bookstore'

const Data = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset legend={t('bookstore/authors.fieldsets.data')} id={'datos'}>
        <Form.Item
          label={t('bookstore/authors.fields.name.label')}
          name={'name'}
          rules={[
            {
              required: true,
              validator: BookStore.fullNameValidator,
            },
          ]}>
          <BookStore.FullNameInput />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='otros campos' id={'otro'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function AuthorForm(props: FormDataProps) {
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: 'Principal',
            children: Data(),
          },
        ]}
      />

      {/*{Data()}*/}
    </FormData>
  )
}
