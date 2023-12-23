import * as BookStore from '@crud/bookstore'
export const authorRenderer = (author: BookStore.Author): string => {

  return BookStore.fullNameRenderer(author.name)
}
