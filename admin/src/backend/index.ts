export const i18nNamespaces = [
  'auth',
  'dashboard',
  'bookstore/tags',
  'bookstore/books',
  'bookstore/authors',
  'music/discos',
  'music/songs',
]

export const resources = (lang: string) => {
  return [
    {
      name: 'dashboard',
      list: `${lang}/dashboard`,
    },
    {
      name: 'bookstore/books',
      list: `${lang}/bookstore/books`,
      create: `${lang}/bookstore/books/create`,
      edit: `${lang}/bookstore/books/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
    {
      name: 'bookstore/authors',
      list: `${lang}/bookstore/authors`,
      create: `${lang}/bookstore/authors/create`,
      edit: `${lang}/bookstore/authors/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
    {
      name: 'bookstore/tags',
      list: `${lang}/bookstore/tags`,
      create: `${lang}/bookstore/tags/create`,
      edit: `${lang}/bookstore/tags/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
    {
      name: 'music/discos',
      list: `${lang}/music/discos`,
      create: `${lang}/music/discos/create`,
      edit: `${lang}/music/discos/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
  ]
}
