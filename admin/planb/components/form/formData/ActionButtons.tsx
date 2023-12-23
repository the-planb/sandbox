import { Dropdown, FormInstance, MenuProps, Space } from 'antd'
import { RedirectAction, useTranslate } from '@refinedev/core'
import { DownOutlined } from '@ant-design/icons'
import React, { useState } from 'react'
import { PageFormProps } from '@planb/components/form/formData/PageForm'
import { DeleteButton } from '@refinedev/antd'

type ActionButtonsProps = {
  form: FormInstance
  disabled: boolean
  onFinish: PageFormProps['onFinish']
  redirect: PageFormProps['redirect']
}

export const ActionButtons = ({
                                form,
                                onFinish,
                                redirect,
                                disabled,
                              }: ActionButtonsProps) => {
  const t = useTranslate()
  const [loading, setLoading] = useState<boolean>(false)

  const onClick = async (action: RedirectAction) => {
    setLoading(true)
    const values = form.getFieldsValue()
    await onFinish(values)

    redirect(action)
    setLoading(false)
  }

  const items: MenuProps['items'] = [
    {
      label: t('buttons.saveAndBack'),
      key: 'saveAndBack',
      onClick: () => onClick('list'),
    },
    {
      label: t('buttons.saveAndCreate'),
      key: 'saveAndCreate',
      onClick: () => onClick('create'),
    },
  ]

  return <Space>
    <DeleteButton
      key={'delete'}
      icon={null}
      danger
      onSuccess={() => {
        redirect('list')
      }}
    />

    <Dropdown.Button
      key={'save'}
      loading={loading}
      icon={<DownOutlined />}
      type={'primary'}
      menu={{ items }}
      onClick={() => onClick('edit')}
      disabled={disabled}>
      {t('buttons.save')}
    </Dropdown.Button>
  </Space>

}
