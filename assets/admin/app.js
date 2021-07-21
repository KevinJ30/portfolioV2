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

