<template>
    <div>
        <div class="my-3">
            <h4>Les évènements à venir</h4>
            <div v-for="myFutureEvent in myFutureEvents" :key="myFutureEvent.id" class="d-flex justify-content-between py-1">
                <h5>Le {{ formatedDate(myFutureEvent.event_date) }} : {{ myFutureEvent.title }}</h5>
                <a type="button" class="btn btn-perso py-1" :href="`inscription/${myFutureEvent.id}`">Détails</a>
            </div>
        </div>
        <div class="my-3">
            <h4>Les évènements passés</h4>
            <div v-for="myPastEvent in myPastEvents" :key="myPastEvent.id" class="d-flex justify-content-between py-1">
                <h5>Le {{ formatedDate(myPastEvent.event_date) }} : {{ myPastEvent.title }}</h5>
                <a type="button" class="btn btn-perso py-1" :href="`inscription/${myPastEvent.id}`">Détails</a>
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
            myEvents: []
        }
    },

    computed: {
        myPastEvents: function () {
            let pastEvents = this.myEvents.filter(myEvent => new Date(myEvent.event_date) < new Date());
            return pastEvents;
        },
        myFutureEvents: function () {
            let futureEvents = this.myEvents.filter(myEvent => new Date(myEvent.event_date) >= new Date());
            return futureEvents;
        }
    },

    methods: {
        formatedDate (date) {
            return moment(date).format('ll');
        },
        },

    created() {
        axios.get('http://localhost/Projet5/public/myEvents')
        .then(response => this.myEvents = response.data)
        .catch(error => console.log(error));
    },

}
</script>
