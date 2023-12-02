import { BaseRecord } from '@refinedev/core'
import * as BookStore from '@crud/bookstore'

export interface Tag extends BaseRecord {
  '@id': string
  id: string
  name: BookStore.TagName
}
