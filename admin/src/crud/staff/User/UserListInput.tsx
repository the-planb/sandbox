import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as Staff from '@crud/staff'

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
                  <Staff.UserNameInput
                    label={
                      key === 0
                        ? t('fields.name.label', { ns: 'staff/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'name']}
                  />
                  <Staff.EmailInput
                    label={
                      key === 0
                        ? t('fields.email.label', { ns: 'staff/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'email']}
                  />
                  <Staff.RoleListInput
                    label={
                      key === 0
                        ? t('fields.roles.label', { ns: 'staff/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'roles']}
                  />
                  <Staff.PasswordInput
                    label={
                      key === 0
                        ? t('fields.password.label', { ns: 'staff/users' })
                        : ''
                    }
                    required={true}
                    name={[name, 'password']}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'staff/users' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
