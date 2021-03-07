import React from 'react';
import { Link } from 'react-router-dom';

export class Header extends React.Component {
    render() {
        return (
            <header>
                <div className="navbar">
                    <div className="flex">
                        <h1 className="logo">Logo</h1>
                        <nav>
                            <ul>
                                <li><Link to="/">Accueil</Link></li>
                                <li><Link to="/user/profil">Mon profil</Link></li>
                                <li><a href="/logout">Se déconnecter</a></li>
                            </ul>
                            <div className="nav-icon">
                                <span>Icon</span>
                                <div className="dropdown-nav">
                                    <Link to="/">Accueil</Link>
                                    <Link to="/user/profil">Mon profil</Link>
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