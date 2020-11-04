<template>
    <div>
        <button type="button" class="btn btn-perso w-25 mb-4 shadow position-relative" style="left: 50%; transform: translateX(-50%);" data-toggle="modal" data-target="#eventModal">
                Créer un nouvel évènement
        </button>
        <create-event-component @event-created="refreshEvents"></create-event-component>

        <div v-for="futureEvent in futureEvents" :key="futureEvent.id" class="d-flex justify-content-between py-1">
            <p>Le {{ formatedDate(futureEvent.event_date) }} : {{ futureEvent.title }}</p>
            <div>
                <button type="button" class="btn btn-perso py-1" :href="`inscription/${futureEvent.id}`">Modifier</button>
                <button type="button" class="btn btn-danger py-1" @click="deleteEvent(futureEvent.id)">Supprimer</button>
            </div>
        </div>
        <div v-show="showDeleteSpinner" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8;">
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
                futureEvents: {},
                showDeleteSpinner: false
            }
        },

        created() {
            axios.get('http://localhost/Projet5/public/futureEventsList')
            .then(response => this.futureEvents = response.data)
            .catch(error => console.log(error));
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },

            refreshEvents(futureEvents) {
                this.futureEvents = futureEvents.data;
            },

            deleteEvent(id) {
                if(confirm("Etes vous sûr de vouloir supprimer cet évènement ?")) {
                this.showDeleteSpinner = true;
                axios.delete('http://localhost/Projet5/public/futureEventsList/' + id)
                .then((response) => {
                    this.futureEvents = response.data;
                    this.showDeleteSpinner = false;
                })
                .catch(error => console.log(error));
            }
            }
        },

    }
</script>
