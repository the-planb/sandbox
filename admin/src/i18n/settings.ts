import { i18nNamespaces } from '@backend'

export const fallbackLng = 'es'
export const languages = [fallbackLng, 'en']
export const defaultNS = 'common'
export const cookieName = 'i18next'

export function getOptions(lng = fallbackLng, defaultNS: string = 'common') {
  return {
    // debug: true,
    supportedLngs: languages,
    fallbackLng,
    lng,
    fallbackNS: defaultNS,
    defaultNS,
    ns: ['common', ...i18nNamespaces],
    interpolation: {
      escapeValue: false,
    },
  }
}
