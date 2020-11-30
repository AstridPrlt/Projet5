<template>
<div>
    <div>
        <a :href="`coweerkers`" type="button" class="btn btn-perso my-2 position-relative" style="left: 50%; transform: translateX(-50%);">Voir la liste des coweerkers</a>

        <div class="card-deck d-flex flex-wrap justify-content-center my-3">
            <div v-for="myContact in myContacts" :key="myContact.id" class="card" style="width: 9rem; min-width: 9rem; flex: 0;">
                <img :src="`./../public/storage/${myContact.avatar}`" class="card-img-top rounded-circle m-auto pt-2" style="width: 7rem;" :alt="`Photo de profil de ${myContact.name}`">
                <div class="card-body p-2">
                    <h5 class="card-title">{{ myContact.name }}</h5>
                    <p class="card-text" style="color: teal;">{{ myContact.job }}</p>
                </div>
                <div class="card-footer d-flex justify-content-around p-2">
                    <a type="button" title="Description" data-toggle="modal" :data-target="`#descriptionModal${myContact.id}`" style="color: teal;">
                        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" data-toggle="tooltip" data-placement="top" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg>
                    </a>
                    <a type="button" :href="`contactUsers/${myContact.id}`" data-toggle="tooltip" data-placement="top" title="Envoyer un message" style="color: teal;">
                        <svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-chat-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/><path fill-rule="evenodd" d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/></svg>
                    </a>
                    <a @click="removeContact(myContact.id)" type="button" data-toggle="tooltip" data-placement="top" title="Supprimer des favoris" style="color: red;">
                        <svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </div>

                <!-- Modal Description-->
                <div class="modal fade" :id="`descriptionModal${myContact.id}`" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="descriptionModalLabel">{{ myContact.name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">{{ myContact.user_description }}</div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <div v-show="spinnerContact" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8;">
        <div v-show="spinnerContact" class="lds-ripple"><div></div><div></div></div>
    </div>
</div>
</template>

<script>
export default {

    data() {
        return {
            myContacts: [],
            spinnerContact: false
        }
    },

    created() {
        this.getContacts();
    },

    methods: {

        getContacts(){
            this.spinnerContact = true;
            axios.get('http://localhost/Projet5/public/myContacts')
            .then((response) => {
                this.myContacts = response.data;
                this.spinnerContact = false
            })
            .catch((error) => {
                console.log(error);
                this.spinnerContact = false;
            });
        },

        removeContact(userId) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) {
            this.spinnerContact = true;
            axios.delete('http://localhost/Projet5/public/removeContact/' + userId)
            .then((response) => {
                console.log(response.data);
                this.getContacts();
                this.spinnerContact = false;
            })
            .catch((error) => {
                console.log(error);
                this.spinnerContact = false;
            });
        }
        }
    }

}
</script>

