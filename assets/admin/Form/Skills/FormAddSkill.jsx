import React from 'react';

export function FormAddSkill() {
    return <form id="js-form-add-skill" action="#">
        <div className="form-group">
            <label htmlFor="name">Nom du skill</label>
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

        <button className="btn btn-primary mt-2" type="submit">Enregistrer</button>
    </form>;
}