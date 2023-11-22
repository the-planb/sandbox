import { type ReactNode } from 'react'
import { Anchor, type AnchorProps, Col, Row } from 'antd'
import css from './style.module.scss'
import { useErrorBag } from '@planb/components/form'
import { type AnchorLinkItemProps } from 'antd/es/anchor/Anchor'

import { nodeTree } from '@planb/components/form/nodeTree'
import { useFormContext } from '@planb/components/form/formData/useFormContext'
import classNames from 'classnames'

interface TocProps {
  children: ReactNode | ReactNode[]
}

export function Toc ({ children }: TocProps) {
  const { errorFieldsets } = useErrorBag()
  const { like } = useFormContext()

  const items: AnchorLinkItemProps[] = nodeTree({ children })
    .fieldsets((props, index, node) => {
      return {
        title: props.legend,
        key: index,
        href: `#${props.id}`,
        className: errorFieldsets[props.id] ? 'error' : undefined
      }
    })

  const hasToc = items.length > 1
  const anchorProps: AnchorProps = {
    affix: false,
    getContainer: () => (document.querySelector(`.${css.toc} .anchor-container`) as HTMLElement),
    offsetTop: 10,
    targetOffset: 50,
    showInkInFixed: true,
    items
  }

  const className = classNames(css.toc, 'toc')

  const linksSizes = {
    xs: 24,
    sm: 24,
    md: like === 'view' || hasToc ? 6 : 24,
    lg: like === 'view' || hasToc ? 6 : 24
  }

  const formSizes = {
    xs: 24,
    sm: 24,
    md: calculePanelSize(24, false, hasToc),
    lg: calculePanelSize(24, like === 'view', true)
  }

  return <Row className={className}>
    <Col className={'anchor-links'} {...linksSizes}>
      {hasToc && <Anchor {...anchorProps}/>}
    </Col>
    <Col className={'anchor-container'} {...formSizes} >
      {children}
    </Col>
  </Row>
}

const calculePanelSize = (space: number, isLarge: boolean, hasToc: boolean) => {
  if (hasToc) {
    space = space - 6
  }

  if (isLarge) {
    space = space - 6
  }

  return space
}
