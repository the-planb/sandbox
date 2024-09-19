import React from 'react'
import { Button, Form, FormItemProps, Tooltip } from 'antd'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Media from '@crud/media'

export const MovieListField = ({ name, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item {...props}>
      <Form.List name={name}>
        {(items, { add, remove }) => (
          <>
            <ul className={'entity-list-field'}>
              <li className={'entity-list-field-labels'}>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.title.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.releaseYear.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.director.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.reviews.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.genres.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.overview.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.classification.label', { ns: 'media/movies' })}
                </label>
                <label
                  style={{
                    flex: 1,
                  }}>
                  {t('fields.raw.label', { ns: 'media/movies' })}
                </label>
              </li>

              {items.map(({ key, name, ...restField }) => (
                <li key={key} className={'entity-list-field-row'}>
                  <CloseOutlined onClick={() => remove(name)} />
                  <Media.MovieTitleField
                    name={[name, 'title']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.ReleaseYearField
                    name={[name, 'releaseYear']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.DirectorField
                    name={[name, 'director']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.ReviewField
                    name={[name, 'reviews']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.GenreField
                    name={[name, 'genres']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.OverviewField
                    name={[name, 'overview']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.ClassificationField
                    name={[name, 'classification']}
                    required={false}
                    style={{
                      flex: 1,
                    }}
                  />
                  <Media.ScoreField
                    name={[name, 'raw']}
                    required={false}
                    style={{
                      flex: 1,
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
