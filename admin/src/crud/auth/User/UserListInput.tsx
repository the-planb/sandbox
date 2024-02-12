import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Auth from '@crud/auth'

export const UserListInput = ({ name, ...props }: FormItemProps) => {
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
                  <Auth.UserNameInput
                    label={
                      key === 0
                        ? t('fields.name.label', { ns: 'auth/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'name']}
                  />
                  <Auth.EmailInput
                    label={
                      key === 0
                        ? t('fields.email.label', { ns: 'auth/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'email']}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'auth/users' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
