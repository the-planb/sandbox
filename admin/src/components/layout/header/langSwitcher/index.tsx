import {Avatar, Button, Dropdown, MenuProps, Space, Typography} from "antd";
import {DownOutlined} from "@ant-design/icons";
import {useGetLocale, useTranslate} from "@refinedev/core";
import Link from "next/link";
import {languages} from '@i18n/settings'
const {Text} = Typography;


export const LangSwitcher = () => {
  const locale = useGetLocale();

  const currentLocale = locale();
  const translate = useTranslate()

  const items: MenuProps['items'] = [...(languages || [])].sort().map((lang: string) => {
    return {
      key: lang,
      label: <Link href={`/${lang}`} locale={lang}>
        {translate(`locale.${lang}`)}
      </Link>,
      icon: <span style={{marginRight: 8}}>
        <Avatar size={16} src={`/admin/images/flags/${lang}.svg`}/>
      </span>
    }
  })

  return <Dropdown menu={{items}} trigger={['click']}>
    <Button type="link">
      <Space>
        <Avatar size={16} src={`/admin/images/flags/${currentLocale}.svg`}/>
        <Text style={{color: "white"}} strong>
          {translate(`locale.${currentLocale}`)}
        </Text>
        <DownOutlined style={{color: "white"}}/>
      </Space>
    </Button>
  </Dropdown>;
}
