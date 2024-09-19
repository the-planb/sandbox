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
        legend={t('fieldsets.data', { ns: 'media/movies' })}
        id={'data'}>
        <Media.MovieTitleField
          name={'title'}
          label={t('fields.title.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
        />
        <Media.ReleaseYearField
          name={'releaseYear'}
          label={t('fields.releaseYear.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
        />
        <Media.DirectorField
          name={'director'}
          label={t('fields.director.label', { ns: 'media/movies' })}
          required={false}
        />
        <Media.ReviewListField
          name={'reviews'}
          label={t('fields.reviews.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
        />
        <Media.GenreField
          name={'genres'}
          label={t('fields.genres.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
          selectProps={{
            mode: 'multiple',
          }}
        />
        <Media.OverviewField
          name={'overview'}
          label={t('fields.overview.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
        />
        <Media.ClassificationField
          name={'classification'}
          label={t('fields.classification.label', { ns: 'media/movies' })}
          required={false}
          className={'fullrow'}
        />
        <Media.ScoreField
          name={'raw'}
          label={t('fields.raw.label', { ns: 'media/movies' })}
          required={false}
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
