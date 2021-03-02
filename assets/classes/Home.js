import React from 'react';

export class Home extends React.Component {
    constructor(props) {
        super(props);
        this.state = { data: [{ "nom": "" }] }
    }

    componentDidMount() {
        fetch('/api/react/participant')
            .then(response => response.json())
            .then(user => {
                this.setState({ data: user });
                console.log(this.state.data);
            })
            .catch(err => console.log(err, 'error'));
    }

    render() {
        var data = this.state.data;
        return (
            <section className="list">
                <div className="container">
                    <div className="flex list-info">
                        <div>
                            <div>Date du jour : XX/XX/XXXX</div>
                            <div>Participant : Doe J.</div>
                        </div>
                    </div>
                    <div>
                        {data[0].pseudo}
                    </div>
                    <div className="title">Filtrer les sorties</div>
                    <form action="#">
                        <div className="grid grid-list">
                            <div className="list-input">
                                <div>
                                    Campus: <select name="" id="">
                                        <option value="">Nantes</option>
                                        <option value="">Rennes</option>
                                        <option value="">Niort</option>
                                    </select>
                                </div>
                                <div>
                                    Contient: <input type="search" name="" id="" />
                                </div>
                                <div>
                                    Entre: <input type="date" name="" id="" />
                            et <input type="date" name="" id="" />
                                </div>
                            </div>
                            <div className="list-check">
                                <div>
                                    <input type="checkbox" name="" id="" /> Sorties dont je suis l'organisateur
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" /> Sorties auxquelles je suis inscrit
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" /> Sorties auxquelles je suis ne suis pas inscrit
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" /> Sorties passées
                                </div>
                            </div>
                            <div className="list-search">
                                <input className="button" type="submit" value="Rechercher" />
                            </div>
                        </div>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom de la sortie</th>
                                <th>Date de la sortie</th>
                                <th>Clôture</th>
                                <th>Inscrits/places</th>
                                <th>État</th>
                                <th>Inscrit</th>
                                <th>Organisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Philo</td>
                                <td>15/03/2020 23:15</td>
                                <td>15/03/2020</td>
                                <td>7/7</td>
                                <td>En cours</td>
                                <td>X</td>
                                <td>Marley B.</td>
                                <td><a href="/afficher">Afficher</a></td>
                            </tr>
                            <tr>
                                <td>Cuisine</td>
                                <td>21/03/2020 20:00</td>
                                <td>20/03/2020</td>
                                <td>6/10</td>
                                <td>En création</td>
                                <td></td>
                                <td>Doe J.</td>
                                <td><a href="/modifier">Modifier</a> - Publier</td>
                            </tr>
                        </tbody>
                    </table>
                    <button className="button">Créer une sortie</button>
                </div>
            </section>
        );
    }
}