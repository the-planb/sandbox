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
        legend={t('fieldsets.data', { ns: 'bookstore/books' })}
        id={'data'}>
        <Form.Item
          label={t('fields.title.label', { ns: 'bookstore/books' })}
          name={'title'}
          rules={[
            {
              required: true,
              validator: BookStore.titleValidator,
            },
          ]}>
          <Input
            placeholder={t('fields.title.placeholder', {
              ns: 'bookstore/books',
            })}
          />
        </Form.Item>

        <Form.Item
          label={t('fields.price.label', { ns: 'bookstore/books' })}
          name={'price'}
          rules={[
            {
              required: false,
              validator: BookStore.priceValidator,
            },
          ]}>
          <InputNumber
            placeholder={t('fields.price.placeholder', {
              ns: 'bookstore/books',
            })}
          />
        </Form.Item>

        <Form.Item
          label={t('fields.author.label', { ns: 'bookstore/books' })}
          name={'author'}
          rules={[
            {
              required: true,
            },
          ]}>
          <BookStore.AuthorInput />
        </Form.Item>

        <Form.Item
          label={t('fields.tags.label', { ns: 'bookstore/books' })}
          name={'tags'}
          rules={[
            {
              required: true,
            },
          ]}>
          <BookStore.TagInput mode='multiple' />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function BookForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'bookstore/books' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
