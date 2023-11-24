'use client'
import React from 'react'
import { Col, Form, Input, Row, Tabs } from 'antd'
import {
  Fieldset,
  FormData,
  type FormDataProps,
  Toc,
} from '@planb/components/form'
import { useTranslate } from '@refinedev/core'
import { AuthorSelect } from '@components/crud/authors'
import { PriceInput, PriceRule } from '@components/form'
import { TagSelect } from '@components/crud/tags/fields/TagSelect'

const Info = () => {
  const t = useTranslate()
  return (
    <>
      <Fieldset legend={t('bookstore/books.fieldsets.data')} id={'datos'}>
        <Form.Item
          label={t('bookstore/books.fields.id')}
          name={'id'}
          rules={[{ required: true }]}>
          <Input readOnly disabled />
        </Form.Item>
        <Form.Item
          label={t('bookstore/books.fields.title')}
          name={'title'}
          rules={[{ required: true }]}
          wrapperCol={{ span: 12 }}>
          <Input />
        </Form.Item>

        <Form.Item
          label={t('bookstore/books.fields.author')}
          name={'author'}
          rules={[{ required: true }]}>
          <AuthorSelect />
        </Form.Item>

        <Form.Item
          label={t('bookstore/books.fields.summary')}
          name={'summary'}
          rules={[{ required: true }]}>
          <Input.TextArea rows={10} />
        </Form.Item>
      </Fieldset>

      <Fieldset
        legend={t('bookstore/books.fieldsets.metadata')}
        id={'metadata'}>
        <Form.Item
          label={t('bookstore/books.fields.price')}
          name={'price'}
          rules={[{ required: true }, { validator: PriceRule }]}>
          <PriceInput />
        </Form.Item>

        <Form.Item label={t('bookstore/books.fields.tags')} name={'tags'}>
          <TagSelect />
        </Form.Item>
      </Fieldset>
    </>
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
            children: <Toc>{Info()}</Toc>,
          },
        ]}></Tabs>
    </FormData>
  )
}
