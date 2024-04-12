import { Button, Form, FormItemProps } from 'antd'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import React from 'react'
import * as Media from '@crud/media'

export const ReviewListField = ({ name, ...props }: FormItemProps) => {
  const t = useTranslate()
  return (
    <Form.Item {...props}>
      <Form.List name={name}>
        {(items, { add, remove }) => (
          <>
            <ul className={'aggregate'}>
              <li className={'labels'}>
                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '50%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.review.label', { ns: 'media/reviews' })}>
                    {t('fields.review.label', { ns: 'media/reviews' })}
                  </label>
                </div>

                <div
                  className='ant-col ant-form-item-label'
                  style={{
                    width: '50%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.score.label', { ns: 'media/reviews' })}>
                    {t('fields.score.label', { ns: 'media/reviews' })}
                  </label>
                </div>
              </li>

              {items.map(({ key, name, ...restField }) => (
                <li key={key}>
                  <CloseOutlined onClick={() => remove(name)} />

                  <Media.ReviewContentField
                    name={[name, 'review']}
                    required={true}
                    style={{
                      width: '50%',
                    }}
                  />

                  <Media.ScoreField
                    name={[name, 'score']}
                    required={true}
                    style={{
                      width: '50%',
                    }}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'media/reviews' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
