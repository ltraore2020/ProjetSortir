import React from 'react'
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import axios from 'axios';

export function SortieForm() {
    return (
        <Formik
            initialValues={{ nom: 'karting' }}
            validationSchema={Yup.object({
                nom: Yup.string().max(15, '15 caractères max')
                    .required('champ obligatoire')
            })}
            onSubmit={(values, { setSubmitting }) => {
                setTimeout(() => {
                    console.log('Form data', values);
                    setSubmitting(false);
                    // updateProfil(values);
                }, 400);

            }}
        >
            {props => (
                <Form>
                    <div className="flex flex-start">
                        <div className="grid wide-input">
                            <label htmlFor="nom">Nom de la sortie :</label>
                            <div>
                                <Field name="nom" type="text" />
                                <ErrorMessage name="nom" />
                            </div>

                            <div>Date et heure de la sortie :</div>
                            <div><input type="datetime-local" placeholder="" /></div>
                            <div>Date limite d'inscription :</div>
                            <div><input type="date" placeholder="" /></div>
                            <div>Nombre de place :</div>
                            <div><input type="number" placeholder="" /></div>
                            <div>Durée (en minutes) :</div>
                            <div><input type="number" placeholder="" /></div>
                            <div>Description et infos :</div>
                            <div><textarea name="" id="" cols="30" rows="4"></textarea></div>
                        </div>
                        <div className="grid wide-input">
                            <div>Campus :</div>
                            <div><select name="" id="">
                                <option value="">Nantes</option>
                                <option value="">Rennes</option>
                                <option value="">Niort</option>
                            </select></div>
                            <div>Ville :</div>
                            <div><input type="text" placeholder="" /></div>
                            <div>Lieu :</div>
                            <div><input type="text" placeholder="" /></div>
                            <div>Rue :</div>
                            <div><input type="text" placeholder="" /></div>
                            <div>Code Postal :</div>
                            <div><input type="text" placeholder="" /></div>
                            <div>Latitude :</div>
                            <div><input type="text" placeholder="" /></div>
                            <div>Longitude :</div>
                            <div><input type="text" placeholder="" /></div>
                        </div>
                    </div>
                    <div className="flex flex-start">
                        {/* <div><input className="button" value="Enregistrer" /></div> */}
                        <button className="button" type="button"
                            onClick={() => handleSave(props.values)}>
                            Enregistrer
                        </button>
                        <button className="button" type="button"
                            onClick={() => handlePublish(props.values)}>
                            Publier la sortie
                        </button>
                        <div><a href="/ToDo" className="button">Annuler</a></div>
                    </div>
                </Form>
            )}
        </Formik>
    )
}

const handlePublish = values => console.log('Publish data', values);


const handleSave = values => console.log('Save data', values);
