import DeleteAction from "./DeleteAction";

export default class SkillEditCustomElement extends HTMLElement {
    connectedCallback() {
        const props = Object.values(this.attributes).map(attribute => [attribute.name, attribute.value])
        let deleteAction = new DeleteAction(this, Object.fromEntries(props));
        deleteAction.init();
    }

    /**
     * déconnection du composant
     **/
    disconnectedCallback () {
    }
}