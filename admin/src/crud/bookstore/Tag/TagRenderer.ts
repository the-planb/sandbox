import * as BookStore from '@crud/bookstore'
export const tagRenderer = (tag: BookStore.Tag): string => {
  return tag.name
}
