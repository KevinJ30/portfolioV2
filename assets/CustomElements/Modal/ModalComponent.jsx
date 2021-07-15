import React, {useEffect, useState} from 'react';
import {createPortal} from "react-dom";

function ModalDialog({content, closeModal, modal_title}) {
    const event = (event) => {
        const modal = document.querySelector('.modal__wrapper');
        const modalRect = modal.getBoundingClientRect();
        const bodyRect = document.body.getBoundingClientRect();

        const blackZoneX = (bodyRect.width - modalRect.width) / 2;
        const blackZoneY = (bodyRect.height - modalRect.height) / 2;
    }

    // Evenement close lorsque l'on clique sur échap
    useEffect(() => {
        document.body.addEventListener('keyup', closeModal);
        window.addEventListener('click', event)

        return () => {
            document.body.removeEventListener('keyup', closeModal);
            window.removeEventListener('click', event)
        }
    }, [])

    return createPortal(<div className="modal">
        <div className="modal__wrapper">
            <button className="modal_button_close" onClick={event => closeModal(event, true)}>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0009 19.9999C8.02319 20.0011 6.08962 19.4154 4.44487 18.3169C2.80013 17.2184 1.51814 15.6565 0.761157 13.8289C0.0041759 12.0013 -0.193768 9.99012 0.192377 8.04994C0.578521 6.10976 1.5314 4.32779 2.9304 2.92953C4.80561 1.05378 7.34893
                    0 10.0009 0C12.6528 0 15.1961 1.05378 17.0713 2.92953C18.9465 4.80528 20 7.34934 20 10.002C20 12.6548 18.9465 15.1988 17.0713 17.0746C16.1447 18.0056 15.0427 18.7436 13.8291 19.2457C12.6154
                     19.7479 11.3142 20.0042 10.0009 19.9999V19.9999ZM2.00487 10.174C2.02758 12.2877 2.88587 14.3065 4.39215 15.7891C5.89842 17.2717 7.93019 18.0976 10.0434 18.0862C12.1566 18.0749 14.1793 17.2272 15.6696
                    15.7285C17.1599 14.2298 17.9964 12.2019 17.9964 10.088C17.9964 7.97419 17.1599 5.9463 15.6696 4.44758C14.1793 2.94886 12.1566 2.10119 10.0434 2.08982C7.93019 2.07846 5.89842 2.90434 4.39215
                    4.38695C2.88587 5.86956 2.02758 7.88833 2.00487 10.002V10.174ZM7.41116 14.0012L6.00187 12.5915L8.59157 10.002L6.00287 7.41259L7.41216 6.00289L10.0009 8.59234L12.5896 6.00289L13.9989 7.41259L11.4102 10.002L13.9989 12.5915L12.5916 14.0012L10.0009 11.4118L7.41216 14.0012H7.41116Z" fill="currentColor"/>
                </svg>
            </button>
            <div className="modal__header">
                <h4>{modal_title}</h4>
            </div>
            <div className="modal__content">
                <div dangerouslySetInnerHTML={{__html: content}} />
            </div>
        </div>
    </div>, document.body);
}

export function Modal({content, button_text, modal_title}) {
    const [visibility, setVisibility] = useState(false)
    const open = (event) => {
        event.preventDefault();
        setVisibility(true);
    }

    const close = (event, button) => {
        if(event.key === 'Escape' || button) {
            setVisibility(false);
        }
    }

    const displayModal = () => {
        return visibility && <ModalDialog content={content} visibility={visibility} closeModal={close} modal_title={modal_title} />;
    }

    return <React.Fragment>
        <button className="btn btn-primary mb-2" onClick={open}>{ button_text }</button>
        { displayModal() }
    </React.Fragment>;
}