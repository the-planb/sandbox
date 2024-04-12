import { Button, Form, FormItemProps, Tooltip } from 'antd'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import React from 'react'
import * as Media from '@crud/media'

export const MovieListField = ({ name, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item {...props}>
      <Form.List name={name}>
        {(items, { add, remove }) => (
          <>
            <ul className={'aggregate'}>
              <li>
                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '25%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.title.label', { ns: 'media/movies' })}>
                    {t('fields.title.label', { ns: 'media/movies' })}
                  </label>
                </div>

                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '25%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.releaseYear.label', {
                      ns: 'media/movies',
                    })}>
                    {t('fields.releaseYear.label', { ns: 'media/movies' })}
                  </label>
                </div>

                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '25%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.reviews.label', { ns: 'media/movies' })}>
                    {t('fields.reviews.label', { ns: 'media/movies' })}
                  </label>
                </div>

                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '25%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.overview.label', { ns: 'media/movies' })}>
                    {t('fields.overview.label', { ns: 'media/movies' })}
                  </label>
                </div>
              </li>

              {items.map(({ key, name, ...restField }) => (
                <li key={key}>
                  <CloseOutlined onClick={() => remove(name)} />

                  <Media.MovieTitleField
                    name={[name, 'title']}
                    required={true}
                    style={{
                      width: '25%',
                    }}
                  />

                  <Media.ReleaseYearField
                    name={[name, 'releaseYear']}
                    required={true}
                    style={{
                      width: '25%',
                    }}
                  />

                  <Media.ReviewListField
                    name={[name, 'reviews']}
                    required={false}
                    style={{
                      width: '25%',
                    }}
                  />

                  <Media.OverviewField
                    name={[name, 'overview']}
                    required={true}
                    style={{
                      width: '25%',
                    }}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'media/movies' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
