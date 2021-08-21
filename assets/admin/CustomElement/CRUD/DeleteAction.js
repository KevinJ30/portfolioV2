/**
 * Construction des button actions
 **/
import {DeleteTemplate} from "./Templates/ButtonTemplates";
import {DeleteActionView} from "./Views/DeleteActionView";
import {alertSuccess} from "./Templates/AlertTemplates";

export default class DeleteAction {
    constructor(element, props) {
        this.props = props;
        this.element = element;
        this.handleActionDelete = this.handleActionDelete.bind(this);
        this.view = new DeleteActionView(this.element, this);
    }

    init() {
        this.view.render();
    }

    handleActionDelete(event) {
        event.preventDefault();

        fetch(this.props.url_action, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: this.props.token,
            })
        })
            .then(response => response.json())
            .then(data => {
                this.view.removeTableElement()
                document.querySelector('.container-fluid').appendChild(alertSuccess(data.message));
            })
            .catch((error) => {
                console.log(error)
            })

        // this.view.removeTableElement();
    }
}