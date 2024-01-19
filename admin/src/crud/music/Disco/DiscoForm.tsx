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

import * as Music from '@crud/music'

const Main = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset
        legend={t('fieldsets.data', { ns: 'music/discos' })}
        id={'data'}>
        <Form.Item
          label={t('fields.title.label', { ns: 'music/discos' })}
          name={'title'}
          rules={[
            {
              required: true,
              validator: Music.discoNameValidator,
            },
          ]}>
          <Input
            placeholder={t('fields.title.placeholder', { ns: 'music/discos' })}
          />
        </Form.Item>

        {/*<Form.Item*/}
        {/*  label={t('fields.songs.label', { ns: 'music/discos' })}*/}
        {/*  name={'songs'}*/}
        {/*  rules={[*/}
        {/*    {*/}
        {/*      required: true,*/}
        {/*    },*/}
        {/*  ]}>*/}
        {/*  <Music.SongInput mode='multiple' />*/}
        {/*</Form.Item>*/}
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function DiscoForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'music/discos' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
