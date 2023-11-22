import { type MetaQuery } from '@refinedev/core'

export const PreloadHeaderCollection = (meta: MetaQuery): HeadersInit => {
  const fields = meta.preload ?? []

  if (fields.length < 1) {
    return {}
  }

  const Preload = fields.map((field: string) => `"hydra:member/*/${field}"`)
    .join(',')

  return { 'X-Preload': Preload }
}

export const PreloadHeaderItem = (meta: MetaQuery): HeadersInit => {
  const fields = meta.preload ?? []

  if (fields.length < 1) {
    return {}
  }

  const Preload = fields.map((field: string) => `"/${field}"`)
    .join(',')

  return { 'X-Preload': Preload }
}
