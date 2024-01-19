import { BaseRecord } from '@refinedev/core'
import * as Music from '@crud/music'

export interface Disco extends BaseRecord {
  '@id': string
  id: string
  title: Music.DiscoName
  songs: Music.Song
}
