import React from 'react'
import { Col, Form, Row } from 'antd'
import { Fieldset, FormData, type FormDataProps } from '@planb/components/form'
import { useTranslate } from '@refinedev/core'
import { FullNameInput } from '@components/form'

const Info = () => {
  const t = useTranslate()
  return <Row>
    <Col span={12} offset={6}>
      <Fieldset legend={t('bookstore/authors.fieldsets.data')} id={'datos-1'}>
        {/* <Form.Item label={t('bookstore/authors.fields.id')} name={'id'} rules={[{required: true}]}> */}
        {/*  <Input readOnly disabled/> */}
        {/* </Form.Item> */}

        <Form.Item label={t('bookstore/authors.fields.name')} name={'name'} rules={[{ required: true }]}>
          <FullNameInput/>
        </Form.Item>

      </Fieldset>
    </Col>
  </Row>
}

export const AuthorForm: React.FC<FormDataProps> = (props: FormDataProps) => {
  const t = useTranslate()

  const merged = ('modalProps' in props && typeof props.modalProps === 'object')
    ? {
        ...props,
        modalProps: {
          ...props.modalProps,
          width: '500px'
        }
      }
    : props

  return <FormData
    {...merged}>
    <Fieldset legend={t('bookstore/authors.fieldsets.data')} id={'datos-1'}>
      {/* <Form.Item label={t('bookstore/authors.fields.id')} name={'id'} rules={[{required: true}]}> */}
      {/*  <Input readOnly disabled/> */}
      {/* </Form.Item> */}

      <Form.Item label={t('bookstore/authors.fields.name')} name={'name'} rules={[{ required: true }]}>
        <FullNameInput/>
      </Form.Item>

    </Fieldset>

  </FormData>
}
