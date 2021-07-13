import React, {useState} from 'react'
import APIFetch from "../../utils/API";

export function EditableInput(props) {
    const [value, setValue] = useState(props.value);

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

    const display_input = () => {
        switch(props.type) {
            case 'textarea':
                return <div className="form-group">
                            <label htmlFor={props.label_id} className={"visually-hidden"}>{props.label}</label>
                            <textarea
                                id={props.label_id}
                                placeholder={props.placeholder}
                                className={props.classname}
                                onChange={handleValueChange}
                                onKeyUp={handleAction}
                                autoFocus={true}>
                                {value}
                            </textarea>
                        </div>;
            default:
                return <div className="form-group">
                    <label htmlFor={props.label_id} className={"visually-hidden"}>{props.label}</label>
                    <input
                        id={props.label_id}
                        type={props.value_type}
                        placeholder={props.placeholder}
                        onChange={handleValueChange}
                        value={value}
                        onKeyUp={handleAction}
                        autoFocus={true}
                        className={props.classname} />
                </div>
        }
    }

    return <React.Fragment>{ display_input() }</React.Fragment>;
}