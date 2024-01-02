import { type ChildrenLike } from '../../nodeTree/utils'
import { itemsMap } from './itemsMap'
import { useMemo, useState } from 'react'
import { type FieldData } from 'rc-field-form/es/interface'
import { isEqual } from 'lodash'

interface Ancestors {
  tabs: string[]
  fieldsets: string[]
}

type FieldsMap = Record<string, Ancestors>

export interface ErrorBag {
  validate: (fields: FieldData[]) => boolean
  errorFieldsets: Record<string, boolean>
  errorTabs: Record<string, boolean>
  isValid: boolean
}

const unique = (values: string[]) => {
  return values.filter((item, index, all) => {
    return all.indexOf(item) === index
  })
}

const build = (
  fields: string[],
  map: FieldsMap,
  type: 'fieldsets' | 'tabs',
) => {
  const all = unique(
    Object.values(map).flatMap((item) => {
      return item[type]
    }),
  )

  const withError = unique(
    fields.flatMap((item) => {
      return map[item][type]
    }),
  )

  return all.reduce((carry, item) => {
    return { ...carry, [item]: withError.includes(item) }
  }, {})
}

export const createErrorBag = (children: ChildrenLike): ErrorBag => {
  const [fields, updateFields] = useState<string[]>([])
  const map = itemsMap(children)

  const validate = (allFields: FieldData[]) => {
    const fieldsWithErrors = allFields
      .filter((field) => {
        return (field.errors?.length as number) > 0
      })
      .flatMap((field) => {
        return field.name as string
      })

    updateFields((prevState) => {
      if (isEqual(prevState.sort(), fieldsWithErrors.sort())) {
        return prevState
      }
      return fieldsWithErrors
    })

    return fieldsWithErrors.length <= 0
  }

  const fieldsets = useMemo(() => {
    return build(fields, map, 'fieldsets')
  }, [fields])

  const tabs = useMemo(() => {
    return build(fields, map, 'tabs')
  }, [fields])

  const isValid = useMemo(() => {
    return fields.length === 0
  }, [fields])

  return {
    validate,
    errorFieldsets: fieldsets,
    errorTabs: tabs,
    isValid,
  }
}
