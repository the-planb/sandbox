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
        <BookStore.TitleInput
          required={true}
          label={t('fields.title.label', { ns: 'bookstore/books' })}
          name={'title'}
        />
        <BookStore.PriceInput
          required={false}
          label={t('fields.price.label', { ns: 'bookstore/books' })}
          name={'price'}
        />
        <BookStore.AuthorInput
          required={true}
          label={t('fields.author.label', { ns: 'bookstore/books' })}
          name={'author'}
        />
        <BookStore.TagInput
          required={true}
          label={t('fields.tags.label', { ns: 'bookstore/books' })}
          name={'tags'}
          selectProps={{ mode: 'multiple' }}
        />
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
