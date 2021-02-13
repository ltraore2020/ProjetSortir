/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
//import './styles/app.css';

// start the Stimulus application
// import './bootstrap';

import React from 'react';
import ReactDOM from 'react-dom';
// import './like_button'

// const el = React.createElement('h2', null, 'hello from React');
const el = <h2> From React JSX <span> \o/ </span> </h2>
ReactDOM.render(el, document.getElementById('like_button_container'));