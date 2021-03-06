/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
//import './styles/app.css';
import './styles/utilities.css';
import './styles/styles.css';

// start the Stimulus application
// import './bootstrap';

import React from 'react';
import ReactDOM from 'react-dom';
import { App } from './classes/App.js';
import { Header } from './classes/Header.js';
import { Home } from './classes/Home.js';
import { ProfilUser } from './classes/ProfilUser.js';
import { CreateSortie } from './classes/CreateSortie.js';

if (document.getElementById('container') != null) {
    ReactDOM.render(<App />, document.getElementById('container'));
} else if (document.getElementById('home') != null) {
    ReactDOM.render(
        <>
            <Header />
            <Home />
        </>,
        document.getElementById('home'));
} else if (document.getElementById('profilUser') != null) {
    ReactDOM.render(
        <>
            <Header />
            <ProfilUser />
        </>,
        document.getElementById('profilUser'));
} else if (document.getElementById('CreateSortie') != null) {
    ReactDOM.render(
        <>
            <Header />
            <CreateSortie />
        </>,
        document.getElementById('CreateSortie'));
}