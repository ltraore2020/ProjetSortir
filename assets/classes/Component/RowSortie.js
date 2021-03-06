import React, { useState, useEffect } from 'react';
import axios from 'axios';

export function RowSortie(props) {
    const sortie = props.sortie;
    const user = props.user;

    const [listeSortie, setlisteSortie] = useState([]);
    const [inscrit, setinscrit] = useState("");
    const [inscription, setinscription] = useState([{ "sortieNoSortie": { "id": 0 } }]);

    const api = axios.create({
        baseURL: '/api'
    });

    const getInscription = async () => {
        let res = await api.get(`/inscription/${user.id}`)
            .then(({ data }) => data)
            .catch(err => console.log(err, 'error'));
        res.map(item => {
            setlisteSortie(prevListeSortie => [...prevListeSortie, item.sortieNoSortie.id]);
        });
    };

    useEffect(() => {
        getInscription();

    }, []);

    useEffect(() => {
        if (listeSortie.includes(sortie.id)) {
            setinscrit("X");
        }
    }, [listeSortie])

    return (
        <tr>
            <td>{sortie.nom}</td>
            <td>{sortie.dateDebut}</td>
            <td>{sortie.dateCloture}</td>
            <td>{sortie.inscrits}/{sortie.nbInscriptionMax}</td>
            <td>{sortie.etatsNoEtat.libelle}</td>
            <td>{inscrit}</td>
            <td>{sortie.organisateur.pseudo}</td>
            <td><a href={`/afficher/${sortie.id}`}>Afficher</a></td>
        </tr>
    )
}
