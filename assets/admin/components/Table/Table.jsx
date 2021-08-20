import React from 'react';
import {TableHead} from "./TableHead";
import {DataGrid} from "./DataGrid";

export function Table({fields, data, displayDataNumber}) {
    return <React.Fragment>
        <table className={"table"}>
            <TableHead data={fields} />
            <DataGrid fields={fields} data={data} />
            <tfoot>
                <tr>
                    <td colSpan={data.length}>Il y a {data.length} élements.</td>
                </tr>
            </tfoot>
        </table>
    </React.Fragment>
}