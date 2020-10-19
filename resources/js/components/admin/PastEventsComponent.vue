<template>
    <div>
        <div v-for="pastEvent in pastEvents" :key="pastEvent.id" class="d-flex justify-content-between py-1">
            <p>Le {{ formatedDate(pastEvent.event_date) }} : {{ pastEvent.title }}</p>
            <a type="button" class="btn btn-perso py-1" :href="`inscription/${pastEvent.id}`">Détails</a>
        </div>
    </div>
</template>

<script>
  import moment from 'moment';
  moment.locale('fr');

    export default {

        data() {
            return {
                pastEvents: {}
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
        },

    }
</script>
