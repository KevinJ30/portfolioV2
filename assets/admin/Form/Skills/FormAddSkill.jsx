import React, {useEffect, useRef, useState} from 'react';
import {FormButtonSubmit} from "../../../Components/Form/FormButtonSubmit";
import APIFetch from "../../../utils/API";

export function FormAddSkill({url_action}) {
    const ref = useRef();
    const [loading, setLoading] = useState(false)

    const handleSubmit = () => {
        setLoading(true);

        APIFetch(url_action, 'POST').then(response => {
            console.log(response.json())
        });
    }

    return <form ref={ref} id="js-form-add-skill" action="#">
        <div className="form-group">
            <label htmlFor="name">Nom de la compétence</label>
            <input id="level" className="form-control" type="text" placeholder="Nom de la compétence"/>
        </div>

        <div className="form-group">
            <label htmlFor="level">Niveau de maitrise</label>
            <input id="level" className="form-control" type="text" placeholder="Niveau de maitrise de la compétence"/>
        </div>

        <div className="form-group">
            <label htmlFor="icon">Icon</label>
            <input id="icon" className="form-control" type="text" placeholder="Icon de la compétence"/>
        </div>

        <FormButtonSubmit classname={"btn btn-primary"} loading={loading} handleClick={handleSubmit}>Enregsitrer</FormButtonSubmit>
    </form>;
}