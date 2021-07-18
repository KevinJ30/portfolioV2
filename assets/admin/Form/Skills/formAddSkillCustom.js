import React from 'react';
import {render, unmountComponentAtNode} from "react-dom";
import {FormAddSkill} from "./FormAddSkill";

export default class FormAddSkillCustom extends HTMLElement {
    /**
     * Connection du composant
     **/
    connectedCallback() {
        const props = Object.values(this.attributes).map(attribute => [attribute.name, attribute.value])
        this.component = <FormAddSkill {...Object.fromEntries(props)} />;
        render(this.component , this);
    }

    /**
     * déconnection du composant
     **/
    disconnectedCallback () {
        unmountComponentAtNode(this);
    }
}
