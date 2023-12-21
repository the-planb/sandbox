'use client'
import React, { Suspense } from 'react'
import { Form, Input, InputNumber, Tabs } from 'antd'
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
      <Fieldset legend={t('bookstore/books.fieldsets.data')} id={'datos'}>
        <Form.Item
          label={t('bookstore/books.fields.title.label')}
          name={'title'}
          rules={[
            {
              required: true,
              validator: BookStore.titleValidator,
            },
          ]}>
          <Input placeholder={t('bookstore/books.fields.title.placeholder')} />
        </Form.Item>

        <Form.Item
          label={t('bookstore/books.fields.price.label')}
          name={'price'}
          rules={[
            {
              required: false,
              validator: BookStore.priceValidator,
            },
          ]}>
          <InputNumber
            placeholder={t('bookstore/books.fields.price.placeholder')}
          />
        </Form.Item>

        <Form.Item
          label={t('bookstore/books.fields.author.label')}
          name={'author'}
          rules={[
            {
              required: true,
            },
          ]}>
          <BookStore.AuthorInput />
        </Form.Item>

        <Form.Item
          label={t('bookstore/books.fields.tags.label')}
          name={'tags'}
          rules={[
            {
              required: true,
            },
          ]}>
          <BookStore.TagInput mode='multiple' />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='otros campos' id={'otro'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function BookForm(props: FormDataProps) {
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
