import * as BookStore from '@crud/bookstore'

export const fullNameRenderer = (fullName: BookStore.FullName): string => {
  return `${fullName.firstName} ${fullName.lastName}`
}
