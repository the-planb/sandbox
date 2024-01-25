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
        <Music.SongNameInput
          required={true}
          label={t('fields.title.label', { ns: 'music/songs' })}
          name={'title'}
        />
        <Music.DurationInput
          required={false}
          label={t('fields.duration.label', { ns: 'music/songs' })}
          name={'duration'}
        />
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
