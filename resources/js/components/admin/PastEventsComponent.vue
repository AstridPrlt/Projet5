<template>
    <div>
        <div v-for="pastEvent in pastEvents" :key="pastEvent.id" class="d-flex justify-content-between py-1">
            <p>Le {{ formatedDate(pastEvent.event_date_time) }} : {{ pastEvent.title }}</p>
            <div class="dropdown">
                <button class="btn btn-perso dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Plus
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button" data-toggle="modal" :data-target="`#listEventModal${pastEvent.id}`">Liste</button>
                    <a type="button" class="dropdown-item" :href="`inscription/${pastEvent.id}`">Détails</a>
                    <button type="button" class="dropdown-item" @click="deleteEvent(pastEvent.id)">Supprimer</button>
                </div>
                <list-event-component :event-id="pastEvent.id"></list-event-component>
                <modify-event-component :event-to-modify="pastEvent"></modify-event-component>
            </div>
        </div>
        <div v-show="showDeleteSpinnerPast" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
  import moment from 'moment';
  moment.locale('fr');

    export default {

        data() {
            return {
                pastEvents: {},
                showDeleteSpinnerPast: false,
            }
        },

        created() {
            axios.get('http://localhost/Projet5/public/pastEventsList')
            .then(response => this.pastEvents = response.data)
            .catch(error => console.log(error));
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },

            deleteEvent(id) {
                if(confirm("Etes vous sûr de vouloir supprimer cet évènement ?")) {
                this.showDeleteSpinnerPast = true;
                axios.delete('http://localhost/Projet5/public/pastEventsList/' + id)
                .then((response) => {
                    this.pastEvents = response.data;
                    this.showDeleteSpinnerPast = false;
                })
                .catch(error => console.log(error));
                }
            },
        }
    }
</script>
