import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const AuthorListInput = ({ name, ...props }: FormItemProps) => {
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
                  <BookStore.FullNameInput
                    label={
                      key === 0
                        ? t('fields.name.label', { ns: 'bookstore/authors' })
                        : ''
                    }
                    required={true}
                    name={[name, 'name']}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'bookstore/authors' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
