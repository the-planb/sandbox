export const i18nNamespaces = [
  'auth',
  'dashboard',
  'sample/vo/money',
  'sample/products',
  'sample/categories',
]

export const resources = (lang: string) => {
  return [
    {
      name: 'dashboard',
      list: `${lang}/dashboard`,
    },
    {
      name: 'sample/products',
      list: `${lang}/sample/products`,
      create: `${lang}/sample/products/create`,
      edit: `${lang}/sample/products/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
    {
      name: 'sample/categories',
      list: `${lang}/sample/categories`,
      create: `${lang}/sample/categories/create`,
      edit: `${lang}/sample/categories/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
  ]
}
