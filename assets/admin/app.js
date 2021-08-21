import './sass/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css'

import 'bootstrap/dist/js/bootstrap.min.js'

/**
 * CustomElements
 **/
import CRUDActionDeleteCustomElement from './CustomElement/CRUD/CRUDActionDeleteCustomElement.js';
customElements.define('crud-action-delete', CRUDActionDeleteCustomElement);

// import SkillEditCustomElement from './CustomElement/SkillEditCustomElement.js';
//
// customElements.define('skill-edit', SkillEditCustomElement)

// /**
//  * Dashboard APP react
//  */
// import ReactDOM from 'react-dom';
//
// import React from 'react';
// import {App} from "./App.jsx";
//
// ReactDOM.render(
//     <React.StrictMode>
//         <App />
//     </React.StrictMode>,
//     document.querySelector('.react-dashboard')
// )

