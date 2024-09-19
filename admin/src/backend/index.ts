export const i18nNamespaces = [
  'auth',
  'dashboard',
  'media/vo/genreName',
  'media/vo/fullName',
  'media/vo/overview',
  'media/vo/score',
  'media/vo/movieTitle',
  'media/vo/releaseYear',
  'media/classifications',
  'media/vo/reviewContent',
  'media/genres',
  'media/ratecalculators',
  'media/movies',
  'media/reviews',
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
        canDelete: true,
      },
    },
    {
      name: 'media/movies',
      list: `${lang}/media/movies`,
      create: `${lang}/media/movies/create`,
      edit: `${lang}/media/movies/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
    {
      name: 'media/directors',
      list: `${lang}/media/directors`,
      create: `${lang}/media/directors/create`,
      edit: `${lang}/media/directors/edit/:id`,
      meta: {
        canDelete: true,
      },
    },
  ]
}
