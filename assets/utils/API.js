/**
 * Récupération des données
 *
 * @param {string} url Url de l'api
 * @param {string} method Methode d'envoie
 * @param {Object} data Deonnées envoyé
 **/
export default async function APIFetch(url, method, data = {}) {
    return await fetch(url, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: method,
        body: JSON.stringify(data)
    });
}