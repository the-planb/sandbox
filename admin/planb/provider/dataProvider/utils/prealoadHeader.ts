import { type MetaQuery } from '@refinedev/core'

export const PreloadHeaderCollection = (fields: string[]): HeadersInit => {
  if (fields.length < 1) {
    return {}
  }

  const Preload = fields
    .map((field: string) => `"hydra:member/*/${field}"`)
    .join(',')

  return { 'X-Preload': Preload }
}

export const PreloadHeaderItem = (fields: string[]): HeadersInit => {
  if (fields.length < 1) {
    return {}
  }

  const Preload = fields.map((field: string) => `"/${field}"`).join(',')

  return { 'X-Preload': Preload }
}
