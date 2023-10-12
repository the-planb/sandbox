const path = require("path");

module.exports = {
  basePath: '/admin',
  sassOptions: {
    includePaths: [path.join(__dirname, 'src', 'styles')],
    prependData: `@import "global.module.scss";`
  },
  env: {
    NEXT_PUBLIC_SERVER_NAME: process.env.NEXT_PUBLIC_SERVER_NAME,
  },
  async redirects() {
    return [
      {
        source: '/',
        destination: '/es/dashboard', // automatically passes the locale on
        permanent: true,
      },
      {
        source: '/es',
        destination: '/es/dashboard', // automatically passes the locale on
        permanent: true,
      },
      {
        source: '/en',
        destination: '/en/dashboard', // automatically passes the locale on
        permanent: true,
      },
    ]
  },
  experimental: {
    newNextLinkBehavior: true,
  },
  transpilePackages: [
    '@refinedev/antd',
    "@refinedev/inferencer",
    'antd',
    '@ant-design/pro-components',
    '@ant-design/pro-layout',
    '@ant-design/pro-utils',
    '@ant-design/pro-provider',
    'rc-pagination',
    'rc-picker'
  ]
};
