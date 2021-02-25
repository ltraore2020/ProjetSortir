
import React from 'react';
import ReactDOM from 'react-dom';

export class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {};

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        console.log('clicked');
    }

    render() {
        let elem = <MyFunction />;
        return (
            <h3 onClick={this.handleClick}>Hello from classes/App.js{elem}</h3>
        )
    }
}

function MyFunction() {
    return (<span> toto </span>);
}