import React, {useState} from 'react'

export function EditableInput(props) {
    const [value, setValue] = useState('');

    const close = () => {
        props.setEditable(false);
    }

    const save = () => {
        let data = {
            key: 'name',
            value: value
        }

        // Sauvegarde dans la base de données requête  HTTP
        fetch(props.url_action, {
            headers: new Headers({
               'Content-Type': 'application/json'
            }),
            method:'PUT',
            body: JSON.stringify(data)
        })
        .then(response => response.json())
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