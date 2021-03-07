
import React from 'react';
import { Header } from './Header';
import { Home } from './Home.js';
import { ProfilUser } from './ProfilUser.js';
import { CreateSortie } from './CreateSortie.js';
import { BrowserRouter as Router, Switch, Route, Link, HashRouter } from 'react-router-dom';

export function App() {
    console.log("in app.js");
    return (
        <HashRouter>
            <Header />
            <Switch>
                <Route path="/user/profil">
                    <ProfilUser />
                </Route>
                <Route path="/sortie/create">
                    <CreateSortie />
                </Route>
                <Route path="/">
                    <Home />
                </Route>

            </Switch>
        </HashRouter>
    )
}