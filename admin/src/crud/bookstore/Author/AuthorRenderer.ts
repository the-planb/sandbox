import * as BookStore from '@crud/bookstore'
import { fullNameRenderer } from '@crud/bookstore'
export const authorRenderer = (author: BookStore.Author): string => {
  return fullNameRenderer(author.name)
}
