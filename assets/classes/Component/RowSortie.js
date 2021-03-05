import React from 'react'

export function RowSortie(props) {
    const sortie = props.sortie;
    console.log(sortie);
    return (
        <tr>
            <td>{sortie.nom}</td>
            <td>{sortie.dateDebut}</td>
            <td>{sortie.dateCloture}</td>
            <td>{sortie.inscrits}/{sortie.nbInscriptionMax}</td>
            <td>{sortie.etatsNoEtat.libelle}</td>
            <td>X</td>
            <td>{sortie.organisateur.pseudo}</td>
            <td><a href={`/afficher/${sortie.id}`}>Afficher</a></td>
        </tr>
    )
}
