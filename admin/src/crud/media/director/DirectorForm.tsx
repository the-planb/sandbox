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
import { Fieldset, FormData, Toc } from '@planb/components'
import { useTranslate } from '@refinedev/core'

import React from 'react'
import * as Media from '@crud/media'

const Main = () => {
  const t = useTranslate()
  return (
    <Toc>
      <Fieldset
        legend={t('fieldsets.data', { ns: 'media/directors' })}
        id={'data'}>
        <Media.FullNameField
          name={'name'}
          required={true}
          label={t('fields.name.label', { ns: 'media/directors' })}
          className={'fullrow'}
        />
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function DirectorForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'media/directors' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}