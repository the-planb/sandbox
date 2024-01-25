'use client'
import React from 'react'
import { Button, Form, Input, InputNumber, Space } from 'antd'

import * as Music from '@crud/music'
import { MinusCircleOutlined, PlusOutlined } from '@ant-design/icons'
import { FormListProps } from 'antd/es/form'

export function SongListInput2(props: Omit<FormListProps, 'children'>) {
  return (
    <Form.Item label={'asdad'}>
      <Form.List {...props}>
        {(fields, { add, remove }) => (
          <>
            {fields.map(({ key, name, ...restField }) => (
              <Space
                key={key}
                style={{ display: 'flex', marginBottom: 8 }}
                align='baseline'>
                <Form.Item
                  {...restField}
                  name={[name, 'title']}
                  rules={[{ required: true, message: 'Missing first name' }]}>
                  <Input placeholder='First Name' />
                </Form.Item>
                <Form.Item
                  {...restField}
                  name={[name, 'duration']}
                  rules={[
                    {
                      required: false,
                      validator: Music.durationValidator,
                    },
                  ]}>
                  <InputNumber placeholder='Last Name' />
                </Form.Item>
                <MinusCircleOutlined onClick={() => remove(name)} />
              </Space>
            ))}
            <Form.Item>
              <Button
                type='dashed'
                onClick={() => add()}
                block
                icon={<PlusOutlined />}>
                Add Song
              </Button>
            </Form.Item>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
