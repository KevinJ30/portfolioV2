import {DeleteTemplate} from "../Templates/ButtonTemplates";
import {alertError, alertSuccess} from "../Templates/AlertTemplates";

export class DeleteActionView {

    constructor(element, action) {
        this.element = element;
        this.action = action;
        this.button = new DeleteTemplate().render();
        this.addEventAction();
        this.tableElement = document.querySelector('table tr[data-id="' + this.action.props.element_id + '"]')
        this.lastElement = this.button;
    }

    alert(type, message) {
        if(type === 'success') {
            document.querySelector('.container-fluid').appendChild(alertSuccess(message))
        }
        else if(type === 'error') {
            document.querySelector('.container-fluid').appendChild(alertError(message))
        }
    }

    setLoading(state) {
        if(state) {
            this.element.querySelector('button').innerHTML = "<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span>";
        }
        else {
            this.element.querySelector('button').innerHTML = "<i class=\"bi bi-trash-fill\" role=\"img\" aria-label=\"Supprimer un élément\"></i>";
        }
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