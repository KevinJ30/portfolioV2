export function alertSuccess(message) {
    let div_alert = document.createElement('div');

    div_alert.classList.add('alert')
    div_alert.classList.add('alert-success')
    div_alert.classList.add('alert-dismissible')
    div_alert.classList.add('fade')
    div_alert.classList.add('show')

    div_alert.setAttribute('role', 'alert')

    div_alert.innerText = message;

    div_alert.appendChild(button_close());

    return div_alert;
}

export function alertError(message) {
    let div_alert = document.createElement('div');

    div_alert.classList.add('alert')
    div_alert.classList.add('alert-error')
    div_alert.classList.add('alert-dismissible')
    div_alert.classList.add('fade')
    div_alert.classList.add('show')

    div_alert.setAttribute('role', 'alert')

    div_alert.innerText = message;

    div_alert.appendChild(button_close());

    return div_alert;
}

function button_close() {
    let button_close = document.createElement('button');
    button_close.classList.add('btn-close')
    button_close.setAttribute('type', 'button');
    button_close.setAttribute('data-bs-dismiss', 'alert');
    button_close.setAttribute('aria-label', 'close');

    return button_close;
}