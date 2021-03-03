import React from 'react';
import { ProfilForm } from './Component/ProfilForm'

export class ProfilUser extends React.Component {
    render() {
        return (
            <section className="profil">
                <div className="container flex flex-start">
                    <div><img src="" alt="" className="profil-pict" />My Picture</div>
                    <div>
                        <div className="title">Mon profil</div>
                        <ProfilForm />
                    </div>
                </div>
            </section>
        );
    }
}