'use client'

import {Button} from "antd";
import {useState} from "react";

export default function Dashboard() {
  const [count, setCounter] = useState<number>(0)
  const handle = () => {
    setCounter(count + 1)
  }

  const prepare = (count: number) => {
    return count * 5
  }

  return <>

    <Button onClick={handle}>Dale</Button>

    COUNT: {prepare(count)}
  </>
}
