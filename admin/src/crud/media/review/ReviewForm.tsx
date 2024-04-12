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
        legend={t('fieldsets.data', { ns: 'media/reviews' })}
        id={'data'}>
        <Media.ReviewContentField
          name={'review'}
          required={true}
          label={t('fields.review.label', { ns: 'media/reviews' })}
          className={'fullrow'}
        />

        <Media.ScoreField
          name={'score'}
          required={true}
          label={t('fields.score.label', { ns: 'media/reviews' })}
          className={'fullrow'}
        />

        <Media.MovieField
          name={'movie'}
          required={true}
          label={t('fields.movie.label', { ns: 'media/reviews' })}
        />
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function ReviewForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'media/reviews' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
