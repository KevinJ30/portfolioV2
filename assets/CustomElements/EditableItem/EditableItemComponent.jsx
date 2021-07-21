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
        return <div onDoubleClick={onDbCLick} dangerouslySetInnerHTML={{ __html: content}} />;
    }
    else {
        return <div className={"js-editable"}>
            <EditableInput
                label_id={props.label_id}
                label={props.label}
                value={content}
                type={props.type}
                value_type={props.value_type}
                placeholder={props.input_placeholder}
                classname={props.classname}
                setEditable={setEditable}
                url_action={props.url_action}
                setContent={setContent}
                field={props.field} />
        </div>;
    }
}