import React, {useEffect, useState} from 'react';
import {createPortal} from "react-dom";

function ModalDialog({content, closeModal}) {
    // Evenement close lorsque l'on clique sur échap
    useEffect(() => {
        document.body.addEventListener('keyup', closeModal);

        return () => {
            document.body.removeEventListener('keyup', closeModal);
        }
    }, [])

    return createPortal(<div className="modal">
        <div className="modal__wrapper">
            <button className="modal_button_close" onClick={closeModal}>x</button>
            <div className="modal__header">
                <h4>Ma super modal</h4>
            </div>
            <div className="modal__content">
                <div dangerouslySetInnerHTML={{__html: content}} />
            </div>
        </div>
    </div>, document.body);
}

export function Modal({content, button_text}) {
    const [visibility, setVisibility] = useState(false)
    const open = (event) => {
        event.preventDefault();
        setVisibility(true);
    }

    const close = () => {
        setVisibility(false);
    }

    const displayModal = () => {
        return visibility && <ModalDialog content={content} visibility={visibility} closeModal={close} />;
    }

    return <React.Fragment>
        <button className="btn btn-primary mb-2" onClick={open}>{ button_text }</button>
        { displayModal() }
    </React.Fragment>;
}