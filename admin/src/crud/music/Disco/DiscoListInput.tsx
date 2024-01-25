import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Music from '@crud/music'

export const DiscoListInput = ({ name, ...props }: FormItemProps) => {
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
                  <Music.DiscoNameInput
                    label={
                      key === 0
                        ? t('fields.title.label', { ns: 'music/discos' })
                        : ''
                    }
                    required={true}
                    name={[name, 'title']}
                  />
                  <Music.SongListInput
                    label={
                      key === 0
                        ? t('fields.songs.label', { ns: 'music/discos' })
                        : ''
                    }
                    required={true}
                    name={[name, 'songs']}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'music/discos' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
