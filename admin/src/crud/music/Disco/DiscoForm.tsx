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
        <Music.DiscoNameInput
          required={true}
          label={t('fields.title.label', { ns: 'music/discos' })}
          name={'title'}
          className={'fullrow'}
        />
      </Fieldset>
      <Fieldset
        legend={t('fieldsets.songs', { ns: 'music/discos' })}
        id={'songs'}>
        <Music.SongListInput
          required={true}
          label={t('fields.songs.label', { ns: 'music/discos' })}
          name={'songs'}
          className={'fullrow'}
        />
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
