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
                                <li><a href="/">Accueil</a></li>
                                <li><a href="/user/profil">Mon profil</a></li>
                                <li><a href="/logout">Se déconnecter</a></li>
                            </ul>
                            <div className="nav-icon">
                                <span>Icon</span>
                                <div className="dropdown-nav">
                                    <a href="/">Accueil</a>
                                    <a href="/user/profil">Mon profil</a>
                                    <a href="/logout">Se déconnecter</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
        );
    }
}