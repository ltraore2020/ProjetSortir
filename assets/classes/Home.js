import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { TableSortie } from './Component/TableSortie';

export function Home() {

    const api = axios.create({
        baseURL: '/api'
    });

    const getUser = async () => {
        let data = await api.get('/user')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setUser(data);
    };

    const getDate = async () => {
        let data = await api.get('/date')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setDate(data);
    };

    const getSorties = async () => {
        let data = await api.get('/sortie')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setSorties(data);
    };

    const [user, setUser] = useState({ "pseudo": "Loading..." });
    const [campus, setCampus] = useState([{ "nom": "Loading..." }]);
    let today = new Date();
    let cDay = String(today.getDate()).padStart(2, '0');
    let cMonth = String(today.getMonth() + 1).padStart(2, '0');
    let cYear = String(today.getFullYear());
    let pageDate = cDay + "/" + cMonth + "/" + cYear;
    console.log(pageDate);
    const [date, setDate] = useState({ "date": pageDate });
    const [sorties, setSorties] = useState([{ "id": 0, "nom": "Loading..." }]);


    useEffect(() => {
        getUser();
        getDate();
        getSorties();
        console.log({ user });
        return () => {
            // cleanup
        }
    }, []);

    console.log({ sorties });
    console.log({ user });
    console.log({ date });

    return (
        <section className="list">
            <div className="container">
                <div className="flex list-info">
                    <div>
                        <div>Date du jour : {date.date}</div>
                        <div>Participant : {user.pseudo}</div>
                    </div>
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
                <TableSortie sorties={sorties} />
                <a href="/sortie/create" className="button">Créer une sortie </a>
            </div>
        </section>
    )
}
