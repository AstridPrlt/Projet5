<template>
    <div>
        <button type="button" class="btn btn-perso mb-4 shadow position-relative" style="left: 50%; transform: translateX(-50%);" data-toggle="modal" data-target="#eventModal">
                Créer un nouvel évènement
        </button>
        <create-event-component @event-created="refreshEvents"></create-event-component>

        <div v-for="futureEvent in futureEvents" :key="futureEvent.id" class="d-flex justify-content-between py-1">
            <p>Le {{ formatedDate(futureEvent.event_date) }} : {{ futureEvent.title }}</p>
            <div class="dropdown">
                    <button class="btn btn-perso dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Plus
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button" data-toggle="modal" :data-target="`#listEventModal${futureEvent.id}`">Liste</button>
                        <button type="button" class="dropdown-item" data-toggle="modal" :data-target="`#modifyEventModal${futureEvent.id}`">Modifier</button>
                        <button type="button" class="dropdown-item" @click="deleteEvent(futureEvent.id)">Supprimer</button>
                    </div>
                <list-event-component :event-id="futureEvent.id"></list-event-component>
                <modify-event-component :event-id-to-modify="futureEvent.id" @event-created="refreshEvents"></modify-event-component>
            </div>
        </div>
        <div v-show="showSpinnerFuture" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8;">
            <div v-show="showSpinnerFuture" class="lds-ripple"><div></div><div></div></div>
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
                showSpinnerFuture: false
            }
        },

        created() {
            this.showSpinnerFuture = true;
            axios.get('http://localhost/Projet5/public/futureEventsList')
            .then((response) => {
                this.futureEvents = response.data;
                this.showSpinnerFuture = false
            })
            .catch((error) => {
                console.log(error);
                this.showSpinnerFuture = false;
            });
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
                this.showSpinnerFuture = true;
                axios.delete('http://localhost/Projet5/public/futureEventsList/' + id)
                .then((response) => {
                    this.futureEvents = response.data;
                    this.showSpinnerFuture = false;
                })
                .catch((error) => {
                console.log(error);
                this.showSpinnerFuture = false;
                });
            }
            }
        },

    }
</script>
