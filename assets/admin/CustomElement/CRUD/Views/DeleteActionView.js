import {DeleteTemplate} from "../Templates/ButtonTemplates";

export class DeleteActionView {

    constructor(element, action) {
        this.element = element;
        this.action = action;
        this.button = new DeleteTemplate().render();
        this.addEventAction();
        this.tableElement = document.querySelector('table tr[data-id="' + this.action.props.element_id + '"]')
    }

    addEventAction() {
        this.event = this.button.addEventListener('click', this.action.handleActionDelete);
    }

    removeTableElement() {
        this.tableElement.remove();
    }

    render() {
        this.element.appendChild(this.button);
    }

}