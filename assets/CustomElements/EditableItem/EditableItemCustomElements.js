import React from 'react';
import {render, unmountComponentAtNode} from "react-dom";
import {EditableItem} from "./EditableItemComponent";

export default class EditableItemCustomElements extends HTMLElement {
    /**
     * Connection du composant
     **/
    connectedCallback() {
        const props = Object.values(this.attributes).map(attribute => [attribute.name, attribute.value])
        this.component = <EditableItem {...Object.fromEntries(props)} />
        render(this.component , this);
    }

    /**
     * déconnection du composant
     **/
    disconnectedCallback () {
        unmountComponentAtNode(this.component);
    }
}

customElements.define('editable-item', EditableItemCustomElements)

