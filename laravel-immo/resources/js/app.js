require('./bootstrap');

let app = {
    init: function()
    {
        // console.log('application initialisée');

        // ajout des eventListeners sur les boutons et formulaires
        document.querySelectorAll('.btn-delete').forEach(item => {
            item.addEventListener('click', app.handleDeleteClick);
        })
        document.querySelectorAll('.btn-edit').forEach(item => {
            item.addEventListener('click', app.handleClickOnEditButton);
        })

        let addAnnonceForm = document.getElementById('addForm');
        addAnnonceForm.addEventListener('submit', app.handleFormAddSubmit);

        let editAnnonceForm = document.getElementById('editForm');
        editAnnonceForm.addEventListener('submit', app.handleFormEditSubmit);
    },

    /**
     * on gère l'événement lié au du bouton delete
     * @param evt
     */
    handleDeleteClick: function(evt) {
        // console.log('click delete')

        // on récupère la cible de l'événement
        let element = evt.currentTarget;
        let url = element.href;

        let config = {
            method: 'DELETE'
        }

        // on consomme l'API
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

    /**
     * on gère l'événement lorsque le formulaire d'ajout est envoyé
     * @param event
     */
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
                // console.log(annonceElement);

                // affichage des données de l'annonce
                annonceElement.querySelector('.annonce-id').textContent = data.id;
                annonceElement.querySelector('.annonce-ref').textContent = data.ref_annonce;
                annonceElement.querySelector('.annonce-prix').textContent = data.prix_annonce;
                annonceElement.querySelector('.annonce-surface').textContent = data.surface_habitable;
                annonceElement.querySelector('.annonce-piece').textContent = data.nombre_de_piece;
                annonceElement.querySelector('.annonce-created-at').textContent = data.created_at;
                annonceElement.querySelector('.annonce-updated-at').textContent = data.updated_at;

                // ajout des dataset
                annonceElement.setAttribute('data-id', data.id);

                // ajout des liens dans le boutons edit et delete
                let editButton = annonceElement.querySelector('.btn-edit');
                let editRoute = "http://localhost:8000/api/annonces/";
                editButton.href = editRoute + data.id;

                let deleteButton = annonceElement.querySelector('.btn-delete');
                let deleteRoute = "http://localhost:8000/api/annonces/delete/";
                deleteButton.href = deleteRoute + data.id;

                // ajout des eventListeners sur les nouveaux boutons
                deleteButton.addEventListener('click', app.handleDeleteClick);
                editButton.addEventListener('click', app.handleClickOnEditButton);

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

    /**
     * on gère l'événement lorsque le formulaire d'édition d'une annonce est envoyé
     * @param event
     */
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
                console.log(data.id);

                // utilisation des datasets pour identifier la ligne à éditer et faire les modifications
                let lineToEdit = document.querySelector('[data-id="' + data.id + '"]');
                // console.log(lineToEdit);
                lineToEdit.querySelector('[data-ref=ref]').textContent = data.ref_annonce;
                lineToEdit.querySelector('[data-prix=prix]').textContent = data.prix_annonce;
                lineToEdit.querySelector('[data-surface=surface]').textContent = data.surface_habitable;
                lineToEdit.querySelector('[data-piece=piece]').textContent = data.nombre_de_piece;
                lineToEdit.querySelector('[data-updated=updated-at]').textContent = data.updated_at;
            });
    },

    /**
     * on gère l'événement lié au clic du bouton d'édition
     * @param event
     */
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
}
document.addEventListener('DOMContentLoaded', app.init);
