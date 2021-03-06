import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { TableSortie } from './Component/TableSortie';
import { SearchForm } from './Component/SearchForm';

export function Home() {

    const [user, setUser] = useState({ "id": 0, "pseudo": "Loading..." });
    const [campus, setCampus] = useState([{ "id": 0, "nom": "Loading..." }]);
    const [date, setDate] = useState({ "date": pageDate });
    const [sorties, setSorties] = useState([{ "id": 1, "nom": "Course", "dateDebut": "20\/03\/2021", "dateCloture": "18\/03\/2021", "nbInscriptionMax": 20, "organisateur": { "pseudo": "Speedy" }, "etatsNoEtat": { "libelle": "Pass\u00e9e" } }]);

    const api = axios.create({
        baseURL: '/api'
    });

    const getUser = async () => {
        let data = await api.get('/user')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setUser(data);
    };

    const getCampus = async () => {
        let data = await api.get('/campus')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setCampus(data);
    };

    const getDate = async () => {
        let data = await api.get('/date')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setDate(data);;
    };

    const getSorties = async () => {
        let data = await api.get('/sortie')
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        setSorties(data);;
    };

    const updateSorties = state => setSorties(state);

    let today = new Date();
    let cDay = String(today.getDate()).padStart(2, '0');
    let cMonth = String(today.getMonth() + 1).padStart(2, '0');
    let cYear = today.getFullYear();
    let pageDate = cDay + "/" + cMonth + "/" + cYear;

    function getdata() {
        return Promise.all([getSorties(), getUser(), getDate(), getCampus()]);
    }

    useEffect(() => {
        getUser();
        getSorties();
        // getdata()
        //     .then(([sorties, user, date, campus]) => {
        //         setSorties(sorties);
        //         setUser(user);
        //         setDate(date);
        //         setCampus(campus);
        //     });
        getDate();
        getCampus();
    }, []);

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
                <SearchForm campus={campus} sorties={sorties} update={updateSorties} />
                <TableSortie sorties={sorties} user={user} />
                <a href="/sortie/create" className="button">Créer une sortie </a>
            </div>
        </section>
    )
}
