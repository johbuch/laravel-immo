require('./bootstrap');

let app = {
    init: function()
    {
        console.log('application initialisée');

        document.querySelectorAll('.btn-delete').forEach(item => {
            item.addEventListener('click', app.handleDeleteClick);
        })

        let addAnnonceForm = document.getElementById('addForm');
        addAnnonceForm.addEventListener('submit', app.handleFormAddSubmit);

        let editAnnonceForm = document.getElementById('editForm');
        editAnnonceForm.addEventListener('submit', app.handleFormEditSubmit);

        document.querySelectorAll('.btn-edit').forEach(item => {
            item.addEventListener('click', app.handleClickOnEditButton);
        })

        // chargement des annonces
        // app.loadAnnonces();
    },

    handleDeleteClick: function(evt) {
        console.log('click delete')
        let element = evt.currentTarget;
        let url = element.href;

        let config = {
            method: 'DELETE'
        }

        fetch(url, config)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if(data.message == 'supprime') {
                    let parent = element.closest('.table-light');
                    // console.log(parent);
                    parent.parentNode.removeChild(parent);
                } else {
                    console.log('ERREUR');
                }
            })
            .catch(function(error) {
                console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
            });
        evt.preventDefault();
    },

    handleFormAddSubmit: function(event) {
        event.preventDefault();

        fetch('http://localhost:8000/api/annonces/add', {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(new FormData(event.target))),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        })
            .then(function (response){
                // console.log(response);
                return response.json();
            })
            .then (function (data) {
                // console.log(data.created_at);

                // récupérer le template d'une annonce
                let template = document.getElementById('template-annonce');

                // cloner le contenu du template
                let newAnnonce = template.content.cloneNode(true);

                let annonceElement = newAnnonce.querySelector('.line-template');

                // affichage des données de l'annonce
                annonceElement.querySelector('.annonce-id').textContent = data.id;
                annonceElement.querySelector('.annonce-ref').textContent = data.ref_annonce;
                annonceElement.querySelector('.annonce-prix').textContent = data.prix_annonce;
                annonceElement.querySelector('.annonce-surface').textContent = data.surface_habitable;
                annonceElement.querySelector('.annonce-piece').textContent = data.nombre_de_piece;
                annonceElement.querySelector('.annonce-created-at').textContent = data.created_at;
                annonceElement.querySelector('.annonce-updated-at').textContent = data.updated_at;

                let tableBody = document.querySelector('tbody');
                // on récupère la première lige du tableau
                let firstChild = tableBody.firstElementChild;

                // ajout du clone dans le DOM avant le firstChild pour la nouvelle annonce s'affiche tout en haut
                template.parentNode.insertBefore(newAnnonce, firstChild);

                // nettoyage du formulaire
                let form = document.getElementById('addForm');
                form.reset();
            });
    },

    handleFormEditSubmit: function(event) {
        event.preventDefault();

        // récupération des informations du formulaire
        let refAnnonce = document.querySelector('input.ref-annonce').value;
        let prixAnnonce = document.querySelector('input.prix-annonce').value;
        let surfaceHabitable = document.querySelector('input.surface-habitable').value;
        let nombreDePiece = document.querySelector('input.nombre-de-piece').value;
        let annonceId = document.querySelector('#editForm input.annonce-id').value;

        fetch('http://localhost:8000/api/annonces/edit/' + annonceId, {
            method: 'PUT',
            body: JSON.stringify(Object.fromEntries(new FormData(event.target))),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        })
            .then(function (response){
                // console.log(response);
                return response.json();
            })
            .then (function (data) {
                console.log(data.created_at);

                // récupérer le template d'une annonce
                let template = document.getElementById('template-annonce');

                // cloner le contenu du template
                let newAnnonce = template.content.cloneNode(true);

                let annonceElement = newAnnonce.querySelector('.line-template');

                // affichage des données de l'annonce
                annonceElement.querySelector('.annonce-id').textContent = data.id;
                annonceElement.querySelector('.annonce-ref').textContent = data.ref_annonce;
                annonceElement.querySelector('.annonce-prix').textContent = data.prix_annonce;
                annonceElement.querySelector('.annonce-surface').textContent = data.surface_habitable;
                annonceElement.querySelector('.annonce-piece').textContent = data.nombre_de_piece;
                annonceElement.querySelector('.annonce-created-at').textContent = data.created_at;
                annonceElement.querySelector('.annonce-updated-at').textContent = data.updated_at;

                // ajout du clone dans le DOM
                template.parentNode.appendChild(newAnnonce);
            });

    },

    handleClickOnEditButton: function(event) {
        // console.log('click edit');
        let element = event.currentTarget;
        // console.log(element);
        let url = element.href;
        // console.log(url);

        let config = {
            method: 'GET'
        }

        fetch(url, config)
            .then(function(response) {
                // console.log(response);
                return response.json();
            })
            .then(function(data) {
                // console.log(data);

                // je pré-rempli les champs du formulaire avec les données de l'annonce
                let refAnnonce = document.querySelector('#editForm input.ref-annonce').value = data.ref_annonce;
                let prixAnnonce = document.querySelector('#editForm input.prix-annonce').value = data.prix_annonce;
                let surfaceHabitable = document.querySelector('#editForm input.surface-habitable').value = data.surface_habitable;
                let nombreDePiece = document.querySelector('#editForm input.nombre-de-piece').value = data.nombre_de_piece;
                let annonceId = document.querySelector('#editForm input.annonce-id').value = data.id;
                }
            );
    },

    // loadAnnonces: function() {
    //     console.log('load annonces');
    //
    //     // préparation de la configuration de la requête HTTP
    //     let config = {
    //         method: 'GET',
    //         mode: 'cors',
    //         cache: 'no-cache'
    //     };
    //
    //     // déclenchement de la requête HTTP avec AJAX
    //     fetch('http://localhost:8000/api/annonces', config)
    //         // on reçoit la réponse en JSON
    //         .then(function(response) {
    //             // console.log(response);
    //             // on convertit la réponse en un objet JS
    //             return response.json();
    //         })
    //         // on récupère le résultat et on le passe en argument
    //         .then(function(data) {
    //             // console.log(data);
    //             for (annonce of data) {
    //                 //console.log(annonce);
    //                 app.addAnnonceToDom(annonce.id, annonce.ref_annonce, annonce.prix_annonce, annonce.surface_habitable, annonce.nombre_de_piece, annonce.created_at, annonce.updated_at);
    //             }
    //         }
    //     );
    // },

    addAnnonceToDom: function(id, refAnnonce, prixAnnonce, surfaceHabitable, nombreDePiece, createdAt, updatedAt) {
        // récupérer le template d'une annonce
        let template = document.getElementById('template-annonce');

        // cloner le contenu du template
        let newAnnonce = template.content.cloneNode(true);

        let annonceElement = newAnnonce.querySelector('.line-template');

        // affichage des données de l'annonce
        annonceElement.querySelector('.annonce-id').textContent = id;
        annonceElement.querySelector('.annonce-ref').textContent = refAnnonce;
        annonceElement.querySelector('.annonce-prix').textContent = prixAnnonce;
        annonceElement.querySelector('.annonce-surface').textContent = surfaceHabitable;
        annonceElement.querySelector('.annonce-piece').textContent = nombreDePiece;
        annonceElement.querySelector('.annonce-created-at').textContent = createdAt;
        annonceElement.querySelector('.annonce-updated-at').textContent = updatedAt;

        // ajout de la ligne dans le DOM
        // let parentNode = document.querySelector('.tbody');
        // newAnnonce.appendChild()

        template.parentNode.appendChild(newAnnonce);
    },

    /**
     * création de l'annonce en utilisant l'API
     */
    createAnnonce: function(refAnnonce, prixAnnonce, surfaceHabitable, nombreDePiece) {
        const token = document.querySelector('meta[name="csrf-token"]');

        // on stocke les données à transférer
        let data = {
            refAnnonce: refAnnonce,
            prixAnnonce: prixAnnonce,
            surfaceHabitable: surfaceHabitable,
            nombreDePiece: nombreDePiece
        };


        // on prépare les entêtes HTTP de la requête
        let myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        // on consomme l'API
        let fetchOptions = {
            method: 'POST',
            // mode: 'cors',
            // cache: 'no-cache',
            // on ajoute les headers dans les options
            // headers: myHeaders,
            body: JSON.stringify(data)
        };

        //on exécute la requête
        fetch('http://localhost:8000/api/annonces/add', fetchOptions)
            .then(function(response) {
                console.log(response);
                return response.json();
            })
            .then(function(data) {
                console.log(data.message);
                // on obtiens le contenu de la réponse
                // console.log('data: ', data);
                // on ajoute la nouvelle annonce dans le DOM en utilisant la fonction addAnnonceToDom
                // app.addAnnonceToDom(data.id, data.refAnnonce, data.prixAnnonce, data.surfaceHabitable, data.nombreDePiece);
            }
        );
    }
}
document.addEventListener('DOMContentLoaded', app.init);
