import ReactDOM, {render, unmountComponentAtNode} from 'react-dom';
import React from 'react';
import SkillEdit from "../components/Skill/Editable";

export default class SkillEditCustomElement extends HTMLElement {
    connectedCallback() {
        const props = Object.values(this.attributes).map(attribute => [attribute.name, attribute.value])
        this.component = <SkillEdit {...Object.fromEntries(props)} />;
        render(this.component , this);
    }

    /**
     * déconnection du composant
     **/
    disconnectedCallback () {
        unmountComponentAtNode(this);
    }
}