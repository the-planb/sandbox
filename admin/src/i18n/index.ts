import {createInstance} from 'i18next'
import resourcesToBackend from 'i18next-resources-to-backend'
import {initReactI18next} from 'react-i18next/initReactI18next'
import {defaultNS, getOptions} from './settings'
import * as i18next from "i18next/index";

const initI18next = async (lang?: string, ns?: string) => {
  const i18nInstance = createInstance()
  await i18nInstance
    .use(initReactI18next)
    .use(resourcesToBackend((language: string, namespace: string) => import(`./locales/${language}/${namespace}.json`)))
    .init(getOptions(lang, ns))
  return i18nInstance
}

type UseTranslationType  = {
  t: (key: string, ns?: object)=>string
  i18n: i18next.i18n
}


export async function useTranslation(lang: string, ns?: string, options = {
  keyPrefix: undefined
}): Promise<UseTranslationType> {

  ns = ns ?? defaultNS
  const i18nextInstance = await initI18next(lang, ns)

  return {
    // @ts-ignore
    t: i18nextInstance.getFixedT(lang, Array.isArray(ns) ? ns[0] : ns, options.keyPrefix),
    i18n: i18nextInstance
  }
}
