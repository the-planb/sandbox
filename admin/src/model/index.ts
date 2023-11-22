import { type BaseRecord } from '@refinedev/core'

export interface IAuthor extends BaseRecord {
  '@id': string
  name: {
    firstName: string
    lastName: string
  }
}

export interface IBook extends BaseRecord {
  title: string
  author: IAuthor
  price: Money
  summary: string
}

export interface Money {
  amount: number
  currency: 'EUR' | 'DOL'
}

export interface FullName {
  firstName: string
  lastName: string
}
