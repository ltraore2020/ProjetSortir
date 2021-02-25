import React from 'react';

export class Header extends React.Component {
    render() {
        return (
            <header>
                <div className="navbar">
                    <div className="flex">
                        <h1 className="logo">Logo</h1>
                        <nav>
                            <ul>
                                <li><a href="/home">Home</a></li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                            <div className="nav-icon">
                                <span>Icon</span>
                                <div className="dropdown-nav">
                                    <a href="/home">Home</a>
                                    <a href="/about">About</a>
                                    <a href="/contact">Contact</a>
                                    <a href="/logout">Logout</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
        );
    }
}