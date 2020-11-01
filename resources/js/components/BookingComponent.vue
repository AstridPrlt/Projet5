<template>
    <!-- <div>
        <div v-for="event in showEvent" :key="event.id" class="w-75 mx-auto mt-4 d-flex flex-wrap">
            <img :src="`./../public/images/events/${ event.event_picture }`" class="w-25" :alt="`${ event.title }`">

            <div class="w-75 text-center">
                <h2>{{ event.title }}</h2>
                <p>Date : Le {{ formatedDate(event.event_date) }}</p>
                <p>De {{ formatedTime(event.begin_time) }} à {{ formatedTime(event.end_time) }}</p>
                <p>Prix : {{ event.price }} €</p>
            </div>

            <p class="w-100 my-5">{{ event.event_description }}</p>
            <button type="button" class="btn btn-perso" @click="eventBooking()">Confirmer</button>
        </div>

    </div> -->

    <div>
        <div class="w-75 mx-auto mt-4 d-flex flex-wrap">
            <img :src="`./../storage/${eventSelected.event_picture}`" class="w-25" :alt="`${ eventSelected.title }`">

            <div class="w-75 text-center">
                <h2>{{ eventSelected.title }}</h2>
                <p>Date : Le {{ formatedDate(eventSelected.event_date) }}</p>
                <p>De {{ formatedTime(eventSelected.begin_time) }} à {{ formatedTime(eventSelected.end_time) }}</p>
                <p>Prix : {{ eventSelected.price }} €</p>
            </div>

            <p class="w-100 my-5" v-html="eventSelected.event_description"></p>
            <button v-show="!isBooked" type="submit" class="btn btn-perso" @click="eventBooking">Confirmer</button>
            <p v-show="isBooked" class="text-bold" style="color: teal; font-size: 1.5rem;">Vous êtes inscrit à cet évènement, rendez-vous le {{ formatedDate(eventSelected.event_date) }} !</p>
        </div>

    </div>

</template>


<script>
  import moment from 'moment';
  moment.locale('fr');

export default {

        props: ['eventSelected', 'booked'],

        // computed: {
        //     showEvent: function () {
        //         return this.events.filter(event => event.id == this.$route.params.id)
        //     }
        // },

        data: function () {
            return {
                isBooked: this.booked
            }
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },
            formatedTime (time) {
                return moment(time, "HH:mm").format('LT');
            },

            eventBooking() {
                axios.post('http://localhost/Projet5/public/eventBooking', {
                    eventId: this.eventSelected.id })
                .then(response => {
                    this.isBooked = 1;
                    console.log(response); })

                .catch(response => {console.log(error);});
            }

            // eventBooking() {
            //     axios.post('http://localhost/Projet5/public/eventBooking', {
            //         event_id: this.$route.params.id })
            //     .then(function (response) {console.log(response);})
            //     .catch(function (error) {console.log(error);});
            // }
        },

        // created() {
        //     axios.get('http://localhost/Projet5/public/eventsList')
        //     .then(response => this.events = response.data)
        //     .catch(error => console.log(error));
        // },

        // mounted() {
        //     console.log(this.$route.params.id)
        // }

        mounted() {
            console.log(this.eventSelected.id);
        }

}
</script>
