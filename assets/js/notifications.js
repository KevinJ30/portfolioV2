/**
 * Comportement des notifications
 *
 * @property {array} notifications
 **/
export class Notification {

    /**
     * @type {number} Durée d'affichage de la notification exprimée en seconde
     **/
    static TIMER_DURATION = 3000;

    /**
     * @param {string} id
     **/
    constructor(id) {
        this.notifications = document.querySelectorAll('#' + id);
        this.bind();
        this.subscribe();
    }

    /**
     * @return {void}
     **/
    bind() {
        this.closeHandler = this.closeHandler.bind(this);
    }

    /**
     * Sélectionne toutes les notifications et les souscrits a l'évènement closeHandler
     * @return {void}
     **/
    subscribe() {
        if(this.notifications) {
            this.notifications.forEach(item => {
                item.querySelector('.btn-close').addEventListener('click', this.closeHandler);
                this.createTimer(item)
            })
        }
    }

    /**
     * Supprime la notification et supprime l'événement
     * @param {Event} event
     */
    closeHandler(event) {
        event.preventDefault();
        this.close(event.target.parentNode);
    }

    /**
     * Lance une animation et supprime l'élément a la fin
     *
     * @param notification
     **/
    close(notification) {
        notification.classList.add('notification-fade-out');
        notification.addEventListener('animationend', event => {
            event.target.remove();
        })
    }

    /**
     * Crée un timer qui va supprimer la notification
     * @param notification
     **/
    createTimer(notification) {
        setTimeout(() => {
            this.close(notification);
        }, Notification.TIMER_DURATION)
    }
}