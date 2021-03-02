import React from 'react';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import axios from 'axios';

const api = axios.create({
    baseURL: '/',
    // headers: {
    //     "Content-Type": "application/json",
    //     'Access-Control-Allow-Origin': '*'
    // }
});

const updateProfil = async data => {
    let res = await api.post('user/update', data);
    // console.log(res);
};

export const ProfilForm = () => {
    return (
        <Formik
            initialValues={{ pseudo: 'bob' }}
            validationSchema={Yup.object({
                pseudo: Yup.string().max(15, '15 caractères max')
                    .required('champ obligatoire')
            })}
            onSubmit={(values, { setSubmitting }) => {
                setTimeout(() => {
                    console.log('Form data', values);
                    setSubmitting(false);
                    updateProfil(values);
                }, 400);

            }}
        >
            <Form>
                <div className="grid grid-profil wide-input">

                    <label htmlFor="pseudo">Pseudo :</label>
                    <div>
                        <Field name="pseudo" type="text" />
                        <ErrorMessage name="pseudo" />
                    </div>


                    <div>Prénom :</div>
                    <div><input type="text" placeholder="Prénom" /></div>
                    <div>Nom :</div>
                    <div><input type="text" placeholder="Nom" /></div>
                    <div>Téléphone :</div>
                    <div><input type="tel" placeholder="Téléphone" /></div>
                    <div>Email :</div>
                    <div><input type="email" placeholder="Email" /></div>
                    <div>Mot de passe :</div>
                    <div><input type="password" placeholder="Mot de passe" /></div>
                    <div>Confirmation :</div>
                    <div><input type="password" placeholder="Confirmation" /></div>
                    <div>Campus :</div>
                    <select name="" id="">
                        <option value="">Nantes</option>
                        <option value="">Rennes</option>
                        <option value="">Niort</option>
                    </select>
                    <div>Ma photo :</div>
                    <div><input type="file" /></div>
                </div>
                <div className="flex flex-start">
                    <div><input className="button" type="submit" value="Enregistrer" /></div>
                    <div><a href="/annuler" className="button">Annuler </a></div>
                </div>
            </Form>
        </Formik>
    );
};