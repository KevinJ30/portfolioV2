import React from 'react';
import {render, unmountComponentAtNode} from "react-dom";
import {Modal} from "./ModalComponent";
import {EditableItem} from "../EditableItem/EditableItemComponent";

export default class ModalCustomElement extends HTMLElement {
    constructor() {
        super();
    }
    /**
     * Connection du composant
     **/
    connectedCallback() {
        const props = Object.values(this.attributes).map(attribute => [attribute.name, attribute.value]);
        const content = ['content', this.innerHTML]
        props.push(content);
        console.log(props)
        this.component = <Modal {...Object.fromEntries(props)} />

        render(this.component, this);
    }

    /**
     * déconnection du composant
     **/
    disconnectedCallback () {
        unmountComponentAtNode(this);
    }
}

