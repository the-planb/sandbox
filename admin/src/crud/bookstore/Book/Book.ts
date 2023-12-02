import { BaseRecord } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export interface Book extends BaseRecord {
  '@id': string
  id: string
  title: BookStore.Title
  price: BookStore.Price
  author: BookStore.Author
  tags: BookStore.Tag
}
