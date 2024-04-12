export const i18nNamespaces = [
  'auth',
  'dashboard',
  'media/genres',
  'media/vo/genreName',
  'media/vo/fullName',
  'media/vo/overview',
  'media/movies',
  'media/vo/score',
  'media/vo/movieTitle',
  'media/vo/releaseYear',
  'media/reviews',
  'media/vo/reviewContent',
  'media/directors',
]

export const resources = (lang: string) => {
  return [
    {
      name: 'dashboard',
      list: `${lang}/dashboard`,
    },
    {
      name: 'media/genres',
      list: `${lang}/media/genres`,
      create: `${lang}/media/genres/create`,
      edit: `${lang}/media/genres/edit/:id`,
      meta: {
        canCreate: true,
      },
    },
    {
      name: 'media/movies',
      list: `${lang}/media/movies`,
      create: `${lang}/media/movies/create`,
      edit: `${lang}/media/movies/edit/:id`,
      meta: {
        canCreate: true,
      },
    },
    {
      name: 'media/directors',
      list: `${lang}/media/directors`,
      create: `${lang}/media/directors/create`,
      edit: `${lang}/media/directors/edit/:id`,
      meta: {
        canCreate: true,
      },
    },
  ]
}
