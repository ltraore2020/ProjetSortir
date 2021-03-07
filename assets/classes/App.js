
import React from 'react';
import { Header } from './Header';
import { Home } from './Home.js';
import { ProfilUser } from './ProfilUser.js';
import { CreateSortie } from './CreateSortie.js';
import { ReadSortie } from './ReadSortie'
import { BrowserRouter as Router, Switch, Route, Link, HashRouter } from 'react-router-dom';

export function App() {
    console.log("in app.js");
    return (
        <HashRouter>
            <Header />
            <Switch>
                <Route path="/" exact>
                    <Home />
                </Route>
                <Route path="/user/profil" exact>
                    <ProfilUser />
                </Route>
                <Route path="/sortie/create" exact>
                    <CreateSortie />
                </Route>
                <Route path="/afficher/:id" exact>
                    <ReadSortie />
                </Route>
            </Switch>
        </HashRouter>
    )
}