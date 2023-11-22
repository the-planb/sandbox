import { BaseKey, type BaseRecord } from '@refinedev/core'
import { type FC } from 'react'

export interface ActionProps {
  record: BaseRecord
}

export type ActionList = Record<string, FC<ActionProps> | false>
