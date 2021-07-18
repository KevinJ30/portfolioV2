import React from 'react';
import {Modal} from "../CustomElements/Modal/ModalComponent";

export function App() {
    return <div>
        <Modal modal_title={"Ma super modal"} button_text={"Envoyer les données"}>
            <p>Mes super de données du site</p>
        </Modal>
        <Modal modal_title={"Ma super modal"} button_text={"OUvrire deuxième modal"}>
            <p>Ma deuxième Modal</p>
        </Modal>
    </div>;
}