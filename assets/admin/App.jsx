import React from 'react';
import {BrowserRouter as Router, Link} from "react-router-dom";
import {AppRoutes} from "./Router";

// const fields = [
//     {name: 'name', content: 'Nom de la compétences'},
//     {name: 'content', content: 'Contenu de la compétences'},
//     {name: 'level', content: 'Niveau de la compétences'}
// ]
//
//
// const data_table = [
//     {id: 5, name: 'Association', content: 'Voici le contenu', level: 5},
//     {id: 6, name: 'Projet PRO', content: 'Mon super projet', level: 1}
// ];

export function App() {
    return <Router>
            <Link to={"/skills"}>Administration des compétences</Link>
            <AppRoutes />
    </Router>;
}