import { BaseRecord } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export interface Book extends BaseRecord {
  '@id': string
  id: string
  title: string
  price: number
  author: Author
}

export const bookRenderer = (book: Book): string => {
  return `TODO: renderBook`
}
