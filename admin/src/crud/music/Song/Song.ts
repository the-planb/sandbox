import { BaseRecord } from '@refinedev/core'
import * as Music from '@crud/music'

export interface Song extends BaseRecord {
  '@id': string
  id: string
  title: Music.SongName
  duration: Music.Duration
  album: Music.Disco
}
