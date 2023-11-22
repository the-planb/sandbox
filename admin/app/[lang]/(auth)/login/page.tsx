'use client'

import { Button, Card, Col, Form, Input, Row, Typography } from 'antd'
import { type ILoginForm, useLogin } from '@refinedev/core'
import vars from '@styles/vars.module.scss'
import Icon from '@components/icon'
import { type PageProps } from '@components/layout'

const { Title } = Typography

export default function Login ({ searchParams }: PageProps) {
  const { colorPrimary } = vars

  const [form] = Form.useForm<ILoginForm>()
  const { mutate } = useLogin<ILoginForm | { redirectTo: string }>()

  const login = (values: ILoginForm) => {
    mutate({
      ...values,
      redirectTo: searchParams.to ?? '/'
    })
  }

  const CardTitle = (
    <Title level={3} className="title">
      Sign in your account
    </Title>
  )

  return <Row
    justify="center"
    align="middle"
    style={{
      height: '100vh'
    }}
  >
    <Col xs={8}>
      <div className="container">
        <div className="imageContainer">
          <Icon.Logo fill={colorPrimary}/>
        </div>
        <Card title={CardTitle} headStyle={{ borderBottom: 0 }}>
          <Form<ILoginForm>
            layout="vertical"
            form={form}
            onFinish={login}
            requiredMark={false}
            initialValues={{
              remember: false
            }}
          >
            <Form.Item
              name="username"
              label="Username"
              rules={[{ required: true }]}
            >
              <Input
                size="large"
                placeholder="Username"
              />
            </Form.Item>
            <Form.Item
              name="password"
              label="Password"
              rules={[{ required: true }]}
              style={{ marginBottom: '12px' }}
            >
              <Input
                type="password"
                placeholder="●●●●●●●●"
                size="large"
              />
            </Form.Item>
            <Button
              type="primary"
              size="large"
              htmlType="submit"
              block
            >
              Sign in
            </Button>
          </Form>
        </Card>
      </div>
    </Col>
  </Row>
}
//
// Login.layout = "auth";
