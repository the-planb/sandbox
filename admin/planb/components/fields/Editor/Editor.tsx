'use client'
import { CKEditor } from '@ckeditor/ckeditor5-react'
import {
  BlockQuote,
  Bold,
  ClassicEditor,
  Code,
  Essentials,
  Heading,
  Highlight,
  HorizontalLine,
  Indent,
  IndentBlock,
  InlineEditor,
  Italic,
  List,
  Paragraph,
  Strikethrough,
  Subscript,
  Superscript,
  Underline,
} from 'ckeditor5'
import { Props } from '@ckeditor/ckeditor5-react/dist/ckeditor'
import 'ckeditor5/ckeditor5.css'
import './style.css'

type ToolbarItem =
  | '|'
  | 'undo'
  | 'redo'
  | 'bold'
  | 'italic'
  | 'underline'
  | 'strikethrough'
  | 'code'
  | 'subscript'
  | 'superscript'
  | 'heading'
  | 'outdent'
  | 'indent'
  | 'bulletedList'
  | 'numberedList'
  | 'blockQuote'
  | 'highlight'
  | 'horizontalLine'

type ToolbarItems = ToolbarItem[] | 'mini' | 'medium' | 'full'

type EditorProps = Omit<
  Props<InlineEditor | ClassicEditor>,
  'editor' | 'onChange' | 'config'
> & {
  value?: string
  onChange?: (value: string) => void
  inline?: boolean
  toolbar?: ToolbarItems
}

const calculeToolbar = (toolbar: ToolbarItems): ToolbarItem[] => {
  const mini = [
    'undo',
    'redo',
    '|',
    'bold',
    'italic',
    '|',
    'underline',
    'strikethrough',
  ]

  const medium = [
    ...mini,
    '|',
    'subscript',
    'superscript',
    '|',
    'bulletedList',
    'numberedList',
    '|',
    'outdent',
    'indent',
  ]

  const full = [
    ...medium,
    '|',
    'code',
    'blockQuote',
    '|',
    'highlight',
    'horizontalLine',
  ]

  if (typeof toolbar === 'string') {
    return { mini, medium, full }[toolbar] as ToolbarItem[]
  }

  return toolbar
}

export default function Editor({
  value,
  toolbar,
  inline,
  onChange,
  ...props
}: EditorProps) {
  const handle = (value: string) => {
    onChange?.(value)
  }

  const plugins = [
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Code,
    Subscript,
    Superscript,
    Indent,
    IndentBlock,
    List,
    Heading,
    BlockQuote,
    Highlight,
    HorizontalLine,
  ]

  const items = calculeToolbar(toolbar ?? 'mini')

  const editor: Props<InlineEditor | ClassicEditor>['editor'] =
    inline === false ? ClassicEditor : InlineEditor

  return (
    <>
      <CKEditor
        editor={editor}
        data={value}
        onChange={(event, data) => {
          handle(data.getData())
        }}
        onReady={(editor) => {
          editor.editing.view.document.on('keyup', (event, data) => {
            if (13 == data.keyCode) {
              data.stopPropagation()
              data.preventDefault()
              event.stop()
              return false
            }
          })
        }}
        config={{
          toolbar: {
            items: items,
          },
          plugins: plugins,
          initialData: value,
        }}
      />
    </>
  )
}
