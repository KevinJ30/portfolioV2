import React from 'react'

export function FormButtonSubmit({classname, children, loading = false, handleClick}) {
    const handleSubmit = (event) => {
        event.preventDefault()
    }
    const display_content = () =>
    {
        if(loading) {
            return 'Chargement...';
        }

        return children;
    }

    return <button className={classname} onClick={handleClick} disabled={loading}>{display_content()}</button>;
}