'use client'

import {BookForm} from "@components/crud/books";
import {useFormData} from "@planb/components/form";

const BooksEditPage = () => {
  const {...props} = useFormData({
    resource: 'bookstore/books',
    action: "edit",
  })

  return <BookForm  {...props} />
}

export default BooksEditPage
