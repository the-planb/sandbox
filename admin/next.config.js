const path = require("path");

module.exports = {
  basePath: '/admin',
  sassOptions: {
    includePaths: [path.join(__dirname, 'src', 'styles')],
    prependData: `@import "global.module.scss";`
  },
  env: {
    NEXT_PUBLIC_ENTRYPOINT: process.env.NEXT_PUBLIC_ENTRYPOINT,
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
  ],
  typescript: {
    // !! WARN !!
    // Dangerously allow production builds to successfully complete even if
    // your project has type errors.
    // !! WARN !!
    ignoreBuildErrors: true,
  },
};
