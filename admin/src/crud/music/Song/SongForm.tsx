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
      <Fieldset legend={t('fieldsets.data', { ns: 'music/songs' })} id={'data'}>
        <Form.Item
          label={t('fields.title.label', { ns: 'music/songs' })}
          name={'title'}
          rules={[
            {
              required: true,
              validator: Music.songNameValidator,
            },
          ]}>
          <Input
            placeholder={t('fields.title.placeholder', { ns: 'music/songs' })}
          />
        </Form.Item>

        <Form.Item
          label={t('fields.duration.label', { ns: 'music/songs' })}
          name={'duration'}
          rules={[
            {
              required: false,
              validator: Music.durationValidator,
            },
          ]}>
          <InputNumber
            placeholder={t('fields.duration.placeholder', {
              ns: 'music/songs',
            })}
          />
        </Form.Item>

        <Form.Item
          label={t('fields.album.label', { ns: 'music/songs' })}
          name={'album'}
          rules={[
            {
              required: true,
            },
          ]}>
          <Music.DiscoInput />
        </Form.Item>
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function SongForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'music/songs' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
