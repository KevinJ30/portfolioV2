import React, {useState} from 'react'
import APIFetch from "../../utils/API";

export function EditableInput(props) {
    const [value, setValue] = useState('');

    const close = () => {
        props.setEditable(false);
    }

    const save = () => {
        APIFetch(props.url_action, 'PUT', {
            key: props.field,
            value: value
        });

        props.setContent(value)
        close();
    }

    const handleValueChange = (event) => {
        setValue(event.target.value)
    }

    const handleAction = (event) => {
        switch(event.key) {
            case 'Escape':
                close();
                break;

            case 'Enter':
                save();
                break;
        }
        if(event.key === 'Escape') {
            props.setEditable(false);
        }
    }

    return <React.Fragment>
        <input type={"text"} placeholder={props.placeholder} onChange={handleValueChange} value={value} onKeyUp={handleAction} autoFocus={true}/>
    </React.Fragment>;
}