import React from 'react';

export function TableHead({data}) {
    return <thead className={"table__head"}>
        <tr>
            {
                data.map(item => <th key={item.name}>{item.content}</th>)
            }
        </tr>
    </thead>;
}