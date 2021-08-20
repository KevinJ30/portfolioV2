import React from 'react';

export function DataGrid({fields, data}) {
    return <tbody className={"table__body"}>
        {
            data.map((item, key) => {
                return <tr key={key}>
                    {
                        fields.map(field => {
                            return <td key={field.name}>{item[field.name]}</td>
                        })
                    }
                </tr>;
            })
        }
    </tbody>;

}