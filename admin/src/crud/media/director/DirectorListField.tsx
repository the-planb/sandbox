import { Button, Form, FormItemProps, Tooltip } from 'antd'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import React from 'react'
import * as Media from '@crud/media'

export const DirectorListField = ({ name, ...props }: FormItemProps) => {
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
                    width: '100%',
                  }}>
                  <label
                    className='ant-form-item-required'
                    title={t('fields.name.label', { ns: 'media/directors' })}>
                    {t('fields.name.label', { ns: 'media/directors' })}
                  </label>
                </div>
              </li>

              {items.map(({ key, name, ...restField }) => (
                <li key={key}>
                  <CloseOutlined onClick={() => remove(name)} />

                  <Media.FullNameField
                    name={[name, 'name']}
                    required={true}
                    style={{
                      width: '100%',
                    }}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'media/directors' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
