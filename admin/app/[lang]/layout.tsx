'use client'

import React, { PropsWithChildren } from 'react'

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

import { languages } from '@i18n/settings'
import { RefineKbar, RefineKbarProvider } from '@refinedev/kbar'
import { LayoutContextProvider } from '@contexts'
import { useTranslation } from '@i18n'
import { type LayoutProps } from 'src/layout'
import vars from '@styles/vars.module.scss'

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
                resources={[
                  {
                    name: 'dashboard',
                    list: `${lang}/dashboard`,
                  },
                  {
                    name: 'bookstore/books',
                    list: `${lang}/bookstore/books`,
                    create: `${lang}/bookstore/books/create`,
                    edit: `${lang}/bookstore/books/edit/:id`,
                    // show: `${lang}/bookstore/books/show/:id`,
                    meta: {
                      canDelete: true,
                      preload: ['author', 'tags'],
                    },
                  },
                  {
                    name: 'bookstore/authors',
                    list: `${lang}/bookstore/authors`,
                    create: `${lang}/bookstore/authors/create`,
                    edit: `${lang}/bookstore/authors/edit/:id`,
                    // show: `${lang}/bookstore/books/show/:id`,
                    meta: {
                      canDelete: true,
                      // preload: ['author'],
                    },
                  },
                  {
                    name: 'bookstore/tags',
                    list: `${lang}/bookstore/tags`,
                    create: `${lang}/bookstore/tags/create`,
                    edit: `${lang}/bookstore/tags/edit/:id`,
                    // show: `${lang}/bookstore/books/show/:id`,
                    meta: {
                      canDelete: true,
                      // preload: ['author'],
                    },
                  },
                ]}
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
