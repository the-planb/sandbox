import React from 'react'
import { useTranslate } from '@refinedev/core'
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
          label={t('fields.review.label', { ns: 'media/reviews' })}
          required={false}
          className={'fullrow'}
        />
        <Media.ScoreField
          name={'score'}
          label={t('fields.score.label', { ns: 'media/reviews' })}
          required={false}
          className={'fullrow'}
        />
        <Media.MovieField
          name={'movie'}
          label={t('fields.movie.label', { ns: 'media/reviews' })}
          required={false}
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
