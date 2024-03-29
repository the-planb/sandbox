'use client'

import React from 'react'

import { Refine } from '@refinedev/core'
import { notificationProvider } from '@refinedev/antd'
import routerProvider from '@refinedev/nextjs-router/app'
import '@refinedev/antd/dist/reset.css'
import { ConfigProvider } from 'antd'
import {
  AccessControlProvider,
  AuthProvider,
  DataProvider,
} from '@planb/provider'
import { dir } from 'i18next'
import { RefineKbar, RefineKbarProvider } from '@refinedev/kbar'
import { LayoutContextProvider } from '@contexts'
import { useTranslation } from '@i18n'
import { type LayoutProps } from 'src/layout'
import vars from '@styles/vars.module.scss'
import { resources } from '@backend'

const Theme = {
  token: {
    colorPrimary: vars.colorPrimary,
  },
}

export default async function Layout({ children, params }: LayoutProps) {
  const { lang } = params

  const { t, i18n } = await useTranslation(lang)
  const i18nProvider = {
    translate: (key: string, params: object) => t(key, params),
    changeLocale: async (lang: string) => await i18n.changeLanguage(lang),
    getLocale: () => i18n.language,
  }

  return (
    <ConfigProvider theme={Theme}>
      <html lang={lang} dir={dir(lang)} suppressHydrationWarning={true}>
        <body>
          <RefineKbarProvider>
            <LayoutContextProvider>
              <Refine
                routerProvider={routerProvider}
                authProvider={AuthProvider()}
                i18nProvider={i18nProvider}
                dataProvider={DataProvider()}
                notificationProvider={notificationProvider}
                accessControlProvider={AccessControlProvider(AuthProvider())}
                resources={resources(lang)}
                options={{
                  syncWithLocation: true,
                  disableTelemetry: true,
                }}>
                {children}
                <RefineKbar />
              </Refine>
            </LayoutContextProvider>
          </RefineKbarProvider>
        </body>
      </html>
    </ConfigProvider>
  )
}
