import React, {useState} from 'react';
import {EditableInput} from "./EditableInputComponent";

export function EditableItem(props) {
    const [editable, setEditable] = useState(false);
    const [content, setContent] = useState(props.content)

    const onDbCLick = (event) => {
        event.preventDefault();
        setEditable(!editable);
    }

    if(!editable) {
        return <div onDoubleClick={onDbCLick}>
            { content }
        </div>;
    }
    else {
        return <div className={"js-editable"}>
            <EditableInput placeholder={props.input_placeholder} setEditable={setEditable} url_action={props.url_action} setContent={setContent} field={props.field} />
        </div>;
    }
}