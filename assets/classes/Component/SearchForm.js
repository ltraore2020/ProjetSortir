import React from 'react'
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import axios from 'axios';



export function SearchForm({ campus, sorties, update }) {
    // const campus = props.campus;
    const liste = campus.map(site => <option key={site.id} value="">{site.nom}</option>);

    const api = axios.create({
        baseURL: '/api'
    });

    const sendSearch = async value => {
        let res = await api.post('/searchSortie', value)
            .then(({ data }) => data);
        update(res);
        console.log('Search data', data);
    };

    return (
        <Formik
            initialValues={{ contient: '' }}
            validationSchema={Yup.object({
                contient: Yup.string()
            })}
            onSubmit={(values, { setSubmitting }) => {
                setTimeout(() => {
                    sendSearch(values);
                    setSubmitting(false);
                }, 400);

            }}>
            <Form>
                <div className="grid grid-list">
                    <div className="list-input">
                        <div>
                            <label>Campus : </label>
                            <Field name="campus" as="select">{liste}</Field>
                        </div>
                        <div>
                            {/* Contient: <input type="search" name="" id="" /> */}
                            <label htmlFor="contient">Contient : </label>
                            <Field name="contient" type="text" />
                            <ErrorMessage name="contient" />
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
            </Form>
        </Formik>
    )
}
