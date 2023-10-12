'use client'

import {Button} from "antd";
import fetchJson from "@planb/provider/ApiClient/fetchJson";
import {ApiUrl} from "@planb/provider";

export default function Dashboard() {

  const handle = async () => {
    const url = ApiUrl("ClientMode")
    fetchJson(url, '/api/bookstore/books')
  }

  return <>
    <Button onClick={handle}>Dale</Button>
  </>
}
