import {
  Button,
  Card,
  CardProps,
  Form,
  type FormInstance,
  FormProps,
} from 'antd'

import css from './style.module.scss'

import { useTranslate } from '@refinedev/core'
import { ReactNode } from 'react'
import {
  defaultFilters,
  FilterList,
  FilterValueList,
} from '@planb/components/datagrid/searchForm/filterValues'

export type SearchFormProps = {
  resource?: string
  cardProps: CardProps
  formProps: FormProps
  filters: FilterList
  defaultValues?: FilterValueList
}
export const SearchForm = ({
  resource,
  cardProps,
  formProps,
  filters,
  defaultValues,
}: SearchFormProps) => {
  const t = useTranslate()
  const onReset = () => {
    const form = formProps.form as FormInstance
    const values = defaultFilters(filters, defaultValues)
    form.resetFields()
    form.setFieldsValue(values)
    form.submit()
  }

  return (
    <Form {...formProps} className={css.filterForm} layout={'vertical'}>
      <Card
        className={css.filterPanel}
        title={t('buttons.filter')}
        actions={[
          <div className={'footer'}>
            <Button htmlType='button' onClick={onReset}>
              {t('buttons.clear')}
            </Button>
            <Button htmlType='submit' type='primary'>
              {t('buttons.search')}
            </Button>
          </div>,
        ]}
        {...cardProps}>
        {Object.entries(filters).map(([name, Input], index) => {
          return (
            <Form.Item
              name={name}
              key={index}
              label={t(`fields.${name}.filter`, { ns: resource })}>
              {Input as ReactNode}
            </Form.Item>
          )
        })}
      </Card>
    </Form>
  )
}
