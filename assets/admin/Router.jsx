import React from 'react'
import {Switch, Route} from 'react-router-dom';
import {AdminSkills} from "./pages/AdminSkills";

export function AppRoutes() {
    return <Switch>
        <Route exact path={"/skills"}>
            <AdminSkills />
        </Route>
    </Switch>;

}