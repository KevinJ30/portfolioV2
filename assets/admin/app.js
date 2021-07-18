import '../sass/app.scss';

/**
 * Dashboard APP react
 */
import ReactDOM from 'react-dom';

import React from 'react';
import {App} from "./App.jsx";

ReactDOM.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>,
    document.querySelector('.react-dashboard')
)

// import ModalCustomElement from "../CustomElements/Modal/ModalCustomElement";
// import FormAddSkillCustom from "./Form/Skills/formAddSkillCustom";
// import EditableItemCustomElements from "../CustomElements/EditableItem/EditableItemCustomElements";
//
// customElements.define('editable-item', EditableItemCustomElements)
// customElements.define('modal-dialog', ModalCustomElement)
// customElements.define('form-add-skill', FormAddSkillCustom)

