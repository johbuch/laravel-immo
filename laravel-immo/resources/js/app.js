require('./bootstrap');

let app = {
    init: function()
    {
        // console.log('application initialisée');
        let deleteForm = document.getElementById('form-delete');
        deleteForm.addEventListener('submit', app.handleFormSubmit);
    },

    handleFormSubmit: function(event)
    {
        let confirmation = window.confirm('Etes-vous sur de vouloir supprimer cette annonce ?')
        if(confirmation) {
            return true;
        } else {
            event.preventDefault();
        }
    }

}
document.addEventListener('DOMContentLoaded', app.init);
