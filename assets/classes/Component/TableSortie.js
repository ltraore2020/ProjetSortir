import React from 'react';
import { RowSortie } from './RowSortie';

export function TableSortie(props) {
    const sorties = props.sorties;
    const rowSorties = sorties.map(sortie => <RowSortie key={sortie.id} sortie={sortie} />);
    return (
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
                {rowSorties}
            </tbody>
        </table>
    )
}
