import React, {useEffect, useRef, useState} from 'react';
import {createPortal} from "react-dom";

/**
 * Detect when click on dead zone on the modal
 *
 * @param ref Modal reference
 * @param {number} clientX Position mouse x
 * @param {number} clientY Position mouse y
 * @returns {boolean}
 **/
function isDeadZone(ref, clientX, clientY) {
    if(ref.current !== null) {
        const bodyRect = document.body.getBoundingClientRect();
        const modalRect = ref.current.getBoundingClientRect();
        let deadZoneX = (bodyRect.width - modalRect.width) / 2;
        let deadZoneY = (bodyRect.height - modalRect.height) / 2;

        if(
            clientX < deadZoneX || clientX > deadZoneX + modalRect.width ||
            clientY < deadZoneY || clientY > deadZoneY + modalRect.height
        ) {
            return true
        }
    }

    return false;
}

/**
 *
 * @param {HTMLElement} content Content of the modal
 * @param closeModal Event close modal
 * @param modal_title Title of the modal
 * @returns {React.ReactPortal}
 * @constructor
 **/
function ModalDialog({children, closeModal, modal_title}) {
    const [load, setLoad] = useState(false);
    const ref = useRef(null);
    let handlerDead = null;

    /**
     * Event escape key pressed
     * @param event
     **/
    const handleEscape = (event) => {
        if(event.key === 'Escape') {
            closeModal()
        }
    }

    /**
     * Event click dead zone on the modal
     * @param event
     */
    const handleClickDeadZone = (event) => {
        if(isDeadZone(ref, event.clientX, event.clientY)) {
            closeModal();
        }
    }

    /**
     * Focus first input if present on the modal
     **/
    const focusFirstElement = () => {
        const firstInput = document.querySelector('.modal input');

        if(firstInput) {
            firstInput.focus();
        }
    }

    // Bind event window and body
    useEffect(() => {
        setLoad(true)
        document.body.addEventListener('keyup', handleEscape);

        return () => {
            document.body.removeEventListener('keyup', handleEscape);
            setLoad(false)
        }
    }, [])

    // Add behavior when load component
    useEffect(() => {
        if(load) {
            window.addEventListener('click', handleClickDeadZone)
            focusFirstElement()
        }
        return () => {
            window.removeEventListener('click', handleClickDeadZone)
        }
    }, [load])

    return createPortal(<div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae consequatur doloremque quia unde veniam.</p>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" className="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        , document.body);
}

/**
 * Base component Modal
 *
 * @param {HTMLElement} content Content of the modal
 * @param button_text Text on the open button
 * @param modal_title Title of the modal
 * @returns {JSX.Element}
 * @constructor
 **/
export function Modal({button_text, modal_title, children}) {
    const [visibility, setVisibility] = useState(false)

    /**
     * Event open modal
     * @param {Event} event
     **/
    const open = (event) => {
        event.preventDefault();
        setVisibility(true);
    }

    /**
     * Event close modal
     * @param event
     **/
    const close = (event) => {
        setVisibility(false);
    }

    /**
     * Display modal dialog
     * @returns {boolean|JSX.Element}
     */
    const displayModal = () => {
        return <ModalDialog visibility={visibility} closeModal={close} modal_title={modal_title}>{children}</ModalDialog>;
    }

    return <React.Fragment>
        <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            {button_text}
        </button>

        { displayModal() }
    </React.Fragment>;
}