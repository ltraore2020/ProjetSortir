import React from 'react'

export function SearchForm(props) {
    const campus = props.campus;
    const liste = campus.map(site => <option key={site.id} value="">{site.nom}</option>);
    return (
        <form action="#">
            <div className="grid grid-list">
                <div className="list-input">
                    <div>
                        Campus: <select name="" id="">
                            {liste}
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
    )
}
