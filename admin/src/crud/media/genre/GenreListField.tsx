import React from 'react'
import { Button, Form, FormItemProps, Tooltip } from 'antd'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Media from '@crud/media'

export const GenreListField = ({ name, ...props }: FormItemProps) => {
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
                  {t('fields.name.label', { ns: 'media/genres' })}
                </label>
              </li>

              {items.map(({ key, name, ...restField }) => (
                <li key={key} className={'entity-list-field-row'}>
                  <CloseOutlined onClick={() => remove(name)} />
                  <Media.GenreNameField
                    name={[name, 'name']}
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
                  {t('titles.create', { ns: 'media/genres' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
