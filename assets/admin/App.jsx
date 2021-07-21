import React from 'react';
import {Modal} from "./components/Modal/ModalComponent";
import {Table} from "./components/Table/Table";

const fields = [
    {name: 'name', content: 'Nom de la compétences'},
    {name: 'content', content: 'Contenu de la compétences'},
    {name: 'level', content: 'Niveau de la compétences'}
]


const data_table = [
    {id: 5, name: 'Association', content: 'Voici le contenu', level: 5},
    {id: 6, name: 'Projet PRO', content: 'Mon super projet', level: 1}
];

export function App() {
    return <div>
        <Modal modal_title={"Ma super modal"} button_text={"Envoyer les données"}>
            <p>Mes super de données du site</p>
        </Modal>
        <Modal modal_title={"Ma super modal"} button_text={"Ouvrire deuxième modal"}>
            <p>Ma deuxième Modal</p>
        </Modal>

        <hr className={"mb-5"}/>

        <Table fields={fields} data={data_table} displayDataNumber />
    </div>;
}