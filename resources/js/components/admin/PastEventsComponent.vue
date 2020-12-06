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
            </div>
        </div>

        <div v-show="showSpinnerPast" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8;">
            <div v-show="showSpinnerPast" class="lds-ripple"><div></div><div></div></div>
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
                showSpinnerPast: false,
            }
        },

        created() {
            this.showSpinnerPast = true;
            axios.get('https://lecowee.astrid-perillat.fr/pastEventsList')
            .then((response) => {
                this.pastEvents = response.data;
                this.showSpinnerPast = false;
            })
            .catch((error) => {
                // console.log(error);
                alert("Il y a eu un problème avec la récupération des évènements");
                this.showSpinnerPast = false;
            });
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },

            deleteEvent(id) {
                if(confirm("Etes vous sûr de vouloir supprimer cet évènement ?")) {
                    this.showSpinnerPast = true;
                    axios.delete('https://lecowee.astrid-perillat.fr/pastEventsList/' + id)
                    .then((response) => {
                        this.pastEvents = response.data;
                        this.showSpinnerPast = false;
                    })
                    .catch((error) => {
                    // console.log(error)
                    alert("Il y a eu un problème avec la suppression de cet évènement");
                    this.showSpinnerPast = false;
                    });
                }
            },
        }
    }
</script>
