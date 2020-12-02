<template>
    <div>
        <div class="my-3">
            <h5 class="text-uppercase text-center text-light" style="background-color: teal;">Les évènements à venir</h5>
            <div v-for="myFutureEvent in myFutureEvents" :key="myFutureEvent.id" class="d-md-flex justify-content-between py-1">
                <p>Le {{ formatedDate(myFutureEvent.event_date) }} : <a :href="`inscription/${myFutureEvent.id}`" style="color: teal;">{{ myFutureEvent.title }}</a></p>
            </div>
            <div v-if="myFutureEvents.length === 0">
                <p class="d-inline">Vous n'avez aucun évènement de prévu. Consultez la </p><a :href="`events`" style="color: teal;">liste des prochains évènements</a>
            </div>
        </div>
        <div class="my-3">
            <h5 class="text-uppercase text-center text-light" style="background-color: teal;">Les évènements passés</h5>
            <div v-for="myPastEvent in myPastEvents" :key="myPastEvent.id">
                <p>Le {{ formatedDate(myPastEvent.event_date) }} : <a :href="`inscription/${myPastEvent.id}`" style="color: teal;">{{ myPastEvent.title }}</a></p>
            </div>
            <div v-if="myPastEvents.length === 0">
                <p>Pas d'évènements passés</p>
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
            myEvents: [],
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
        axios.get('https://lecowee.astrid-perillat.fr/myEvents')
        .then(response => this.myEvents = response.data)
        .catch(error => console.log(error));
    },

}
</script>
