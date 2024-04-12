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
        legend={t('fieldsets.data', { ns: 'media/movies' })}
        id={'data'}>
        <Media.MovieTitleField
          name={'title'}
          required={true}
          label={t('fields.title.label', { ns: 'media/movies' })}
          className={'fullrow'}
        />

        <Media.ReleaseYearField
          name={'releaseYear'}
          required={true}
          label={t('fields.releaseYear.label', { ns: 'media/movies' })}
          className={'fullrow'}
        />

        <Media.DirectorField
          name={'director'}
          required={true}
          label={t('fields.director.label', { ns: 'media/movies' })}
        />

        <Media.ReviewListField
          name={'reviews'}
          required={false}
          label={t('fields.reviews.label', { ns: 'media/movies' })}
          className={'fullrow'}
        />

        <Media.GenreField
          name={'genres'}
          required={false}
          label={t('fields.genres.label', { ns: 'media/movies' })}
          className={'fullrow'}
          selectProps={{
            mode: 'multiple',
          }}
        />

        <Media.OverviewField
          name={'overview'}
          required={true}
          label={t('fields.overview.label', { ns: 'media/movies' })}
          className={'fullrow'}
        />
      </Fieldset>
      <Fieldset legend='Extra Fieldset' id={'extra'}>
        distribuir los campos en varios fieldsets ...
      </Fieldset>
    </Toc>
  )
}

export function MovieForm(props: FormProps) {
  const t = useTranslate()
  return (
    <FormData {...props}>
      <Tabs
        items={[
          {
            key: 'tab-1',
            label: t('tabs.main', { ns: 'media/movies' }),
            children: Main(),
          },
        ]}
      />

      {/*{Main()}*/}
    </FormData>
  )
}
