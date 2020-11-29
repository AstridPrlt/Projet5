<template>
    <div>
        <div class="my-5">
            <div class="card-columns position-relative">
                <div v-for="people in coweerkers" :key="people.id" class="card">
                    <img :src="`./../public/storage/${people.avatar}`" class="card-img-top" :alt="`Photo de profil de ${people.name}`">
                    <div class="card-body">
                        <h5 class="card-title">{{ people.name }}</h5>
                        <h6 class="font-weight-bold" style="color: teal;">{{ people.job }}</h6>
                        <p class="card-text font-italic">{{ people.user_description}}</p>
                        <div class="d-flex justify-content-around">
                            <div style="color: teal; cursor: pointer;">
                                <div v-if="contacts.includes(people.id)" @click="removeContact(people.id)" data-toggle="tooltip" data-placement="top" title="Retirer de mes contacts">
                                    <svg width="1.9em" height="1.9em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                </div>
                                <div v-else @click="addContact(people.id)" data-toggle="tooltip" data-placement="top" title="Ajouter à mes contacts">
                                    <svg width="1.9em" height="1.9em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                    </svg>
                                </div>
                            </div>

                            <a type="button" :href="`contactUsers/${people.id}`" data-toggle="tooltip" data-placement="top" title="Envoyer un message" style="color: teal;">
                                <svg width="1.9em" height="1.9em" viewBox="0 0 16 16" class="bi bi-chat-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/><path fill-rule="evenodd" d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/></svg>
                            </a>
                        </div>

                    </div>
                </div>

                <div v-show="spinner" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8; z-index: 5;">
                    <div v-show="spinner" class="lds-ripple"><div></div><div></div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['coweerkers', 'authContacts'],

    data() {
        return {
            contacts: this.authContacts,
            spinner: false
        }
    },

    methods: {

        addContact(userId) {
            this.spinner = true;
            axios.post('http://localhost/Projet5/public/addContact', {
                userId: userId })
            .then(response => {
                console.log(response.data);
                this.contacts.push(response.data);
                this.spinner = false;
            })
            .catch(error => console.log(error));
        },

        removeContact(userId) {
            this.spinner = true;
            axios.delete('http://localhost/Projet5/public/removeContact/' + userId)
            .then((response) => {
                console.log(response.data);
                let userRemoved = (id) => id == response.data;
                console.log(this.contacts);
                let indexToRemove = this.contacts.findIndex(userRemoved);
                console.log(indexToRemove);
                this.contacts.splice(indexToRemove, 1);
                this.spinner = false;
            })
            .catch(error => console.log(error));
        }
    }

}
</script>
