import { Dropdown, Form, FormInstance, MenuProps, Space } from 'antd'
import {
  FormAction,
  RedirectAction,
  useCan,
  useTranslate,
} from '@refinedev/core'
import { DownOutlined } from '@ant-design/icons'
import React, { useEffect } from 'react'
import { DeleteButton, UseFormReturnType } from '@refinedev/antd'
import { recordWithUris } from '@planb/components'

type ActionButtonsProps = {
  form: FormInstance
  onFinish: UseFormReturnType['onFinish']
  redirect: UseFormReturnType['redirect']
  action: FormAction
  resource: string
}

export const FooterButtons = ({
  form,
  onFinish,
  redirect,
  action,
  resource,
}: ActionButtonsProps) => {
  const t = useTranslate()

  const handleClick = async (action: RedirectAction) => {
    const values = form.getFieldsValue()
    //
    // // const normalized = recordWithUris(values)
    // const normalized = values
    const data = await onFinish(values)

    redirect(action, data?.data?.id)
  }

  const [submittable, setSubmittable] = React.useState(false)

  const values = Form.useWatch([], form)
  useEffect(() => {
    form.validateFields({ validateOnly: true }).then(
      () => {
        setSubmittable(true)
      },
      () => {
        setSubmittable(false)
      },
    )
  }, [values])

  const items: MenuProps['items'] = [
    {
      label: t('buttons.saveAndBack'),
      key: 'saveAndBack',
      onClick: () => handleClick('list'),
    },
    {
      label: t('buttons.saveAndCreate'),
      key: 'saveAndCreate',
      onClick: () => handleClick('create'),
    },
  ]

  return (
    <Space>
      {action === 'edit' && (
        <DeleteButton
          resource={resource}
          key={'delete'}
          icon={null}
          danger
          onSuccess={() => {
            redirect('list')
          }}
        />
      )}

      <Dropdown.Button
        key={'save'}
        icon={<DownOutlined />}
        type={'primary'}
        menu={{ items }}
        onClick={() => handleClick('edit')}
        disabled={!submittable}>
        {t('buttons.save')}
      </Dropdown.Button>
    </Space>
  )
}
