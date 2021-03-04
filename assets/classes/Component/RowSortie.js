import React from 'react'

export function RowSortie(props) {
    const sortie = props.sortie;
    console.log(sortie);
    return (
        <tr>
            <td>{sortie.nom}</td>
            <td>15/03/2020 23:15</td>
            <td>15/03/2020</td>
            <td>7/7</td>
            <td>En cours</td>
            <td>X</td>
            <td>Marley B.</td>
            <td><a href="/afficher">Afficher</a></td>
        </tr>
    )
}
