import './sass/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css'

import 'bootstrap/dist/js/bootstrap.min.js'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

/**
 * CustomElements
 **/
import CRUDActionDeleteCustomElement from './CustomElement/CRUD/CRUDActionDeleteCustomElement.js';
customElements.define('crud-action-delete', CRUDActionDeleteCustomElement);

ClassicEditor
    .create( document.querySelector( '.CKEditor' ), {
        minHeight: '300px'
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    });

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

