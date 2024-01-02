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

import * as BookStore from '@crud/bookstore'

const Main = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset
        legend={t('fieldsets.data', { ns: 'bookstore/tags' })}
        id={'data'}>
        <Form.Item
          label={t('fields.name.label', { ns: 'bookstore/tags' })}
          name={'name'}
          rules={[
            {
              required: true,
              validator: BookStore.tagNameValidator,
            },
          ]}>
          <Input
            placeholder={t('fields.name.placeholder', { ns: 'bookstore/tags' })}
          />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function TagForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'bookstore/tags' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
