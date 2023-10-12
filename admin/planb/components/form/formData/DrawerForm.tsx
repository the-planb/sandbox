import {UseFormDrawerReturnType} from "@planb/components/form/formData/useFormData/useFormDrawer";
import {WithChildren} from "@planb/components/form/formData/types";
import {Drawer} from "antd";
import css from "./style.module.scss";
import {PageForm, PageFormProps} from "@planb/components/form/formData/PageForm";
import React from "react";

export type DrawerFormProps = UseFormDrawerReturnType & WithChildren;

export function DrawerForm({drawerProps, ...props}: DrawerFormProps) {
  return <Drawer {...drawerProps} className={css.drawerForm}>
    <PageForm {...props as PageFormProps}/>
  </Drawer>
}
