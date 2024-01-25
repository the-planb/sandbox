import { Button, Form, FormItemProps, Tooltip } from 'antd'
import React from 'react'
import { CloseOutlined, PlusOutlined } from '@ant-design/icons'
import { useTranslate } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export const BookListInput = ({ name, ...props }: FormItemProps) => {
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
                  <BookStore.TitleInput
                    label={
                      key === 0
                        ? t('fields.title.label', { ns: 'bookstore/books' })
                        : ''
                    }
                    required={true}
                    name={[name, 'title']}
                  />
                  <BookStore.PriceInput
                    label={
                      key === 0
                        ? t('fields.price.label', { ns: 'bookstore/books' })
                        : ''
                    }
                    required={false}
                    name={[name, 'price']}
                  />
                  <BookStore.AuthorInput
                    label={
                      key === 0
                        ? t('fields.author.label', { ns: 'bookstore/books' })
                        : ''
                    }
                    required={true}
                    name={[name, 'author']}
                  />
                  <BookStore.TagInput
                    label={
                      key === 0
                        ? t('fields.tags.label', { ns: 'bookstore/books' })
                        : ''
                    }
                    required={true}
                    name={[name, 'tags']}
                    selectProps={{ mode: 'multiple' }}
                  />
                </li>
              ))}

              <li>
                <Button
                  type='link'
                  onClick={() => add()}
                  icon={<PlusOutlined />}>
                  {t('titles.create', { ns: 'bookstore/books' })}
                </Button>
              </li>
            </ul>
          </>
        )}
      </Form.List>
    </Form.Item>
  )
}
