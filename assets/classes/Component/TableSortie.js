import React, { useState, useEffect } from 'react';
import { RowSortie } from './RowSortie';

export function TableSortie(props) {

    const sorties = props.sorties;
    const user = props.user;

    const rowSorties = sorties.map(
        sortie => <RowSortie key={sortie.id + user.id} sortie={sortie} user={user} />);


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
