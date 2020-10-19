<template>
    <div>
        <div v-for="futureEvent in futureEvents" :key="futureEvent.id" class="d-flex justify-content-between py-1">
            <p>Le {{ formatedDate(futureEvent.event_date) }} : {{ futureEvent.title }}</p>
            <div>
                <a type="button" class="btn btn-perso py-1" :href="`inscription/${futureEvent.id}`">Modifier</a>
                <a type="button" class="btn btn-danger py-1">Supprimer</a>
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
                futureEvents: {}
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
        },

    }
</script>
