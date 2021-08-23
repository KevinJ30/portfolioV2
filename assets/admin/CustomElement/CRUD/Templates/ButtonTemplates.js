export class DeleteTemplate {

    constructor() {
        this.element = null;
        this.buildButton();
    }

    setLoading(state) {
        if(state) {
            this.element.innerHTML = "kevin";
        }
        else {
            this.element.innerHTML = "<i class=\"bi bi-trash-fill\" role=\"img\" aria-label=\"Supprimer un élément\"></i>";
        }
    }

    /**
     * Construit le bouton suppréssion
     **/
    buildButton() {
        this.element = document.createElement('button');
        this.element.classList.add('btn');
        this.element.classList.add('btn-danger');

        this.element.innerHTML = "<i class=\"bi bi-trash-fill\" role=\"img\" aria-label=\"Supprimer un élément\"></i>";
    }

    render() {
        return this.element;
    }

}