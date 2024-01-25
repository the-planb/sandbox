import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Music from '@crud/music'

export const SongListInput = ({ name, ...props }: FormItemProps) => {
  const t = useTranslate()

  return (
    <Form.Item {...props}>
      <Form.List name={name}>
        {(items, { add, remove }) => (
          <>
            <ul className={'aggregate'}>
              {items.map(({ key, name, ...restField }) => (
                <li key={key}>
                  <CloseOutlined
                    onClick={() => remove(name)}
                    className={key === 0 ? 'delete-action-first' : ''}
                  />
                  <Music.SongNameInput
                    label={
                      key === 0
                        ? t('fields.title.label', { ns: 'music/songs' })
                        : ''
                    }
                    required={true}
                    name={[name, 'title']}
                  />
                  <Music.DurationInput
                    label={
                      key === 0
                        ? t('fields.duration.label', { ns: 'music/songs' })
                        : ''
                    }
                    required={false}
                    name={[name, 'duration']}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'music/songs' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
