'use client'
import React from 'react'
import { Col, Form, Input, InputNumber, Row, Space, Tabs } from 'antd'
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
      <Fieldset legend={t('bookstore/tags.fieldsets.data')} id={'datos'}>
        <Form.Item
          label={t('bookstore/tags.fields.name.label')}
          name={'name'}
          rules={[
            {
              required: true,
              validator: BookStore.tagNameValidator,
            },
          ]}>
          <Input placeholder={t('bookstore/tags.fields.name.placeholder')} />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='otros campos' id={'otro'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function TagForm(props: FormDataProps) {
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
