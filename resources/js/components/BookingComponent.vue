<template>
    <div>
        <div v-for="event in showEvent" :key="event.id" class="w-75 mx-auto mt-4 d-flex flex-wrap">
            <img :src="`./../public/images/events/${ event.event_picture }`" class="w-25" :alt="`${ event.title }`">

            <div class="w-75 text-center">
                <h2>{{ event.title }}</h2>
                <p>Date : Le {{ formatedDate(event.event_date) }}</p>
                <p>De {{ formatedTime(event.begin_time) }} à {{ formatedTime(event.end_time) }}</p>
                <p>Prix : {{ event.price }} €</p>
            </div>

            <p class="w-100 my-5">{{ event.event_description }}</p>
            <button type="button" class="btn btn-perso">Confirmer</button>
        </div>

    </div>

</template>


<script>
  import moment from 'moment';
  moment.locale('fr');

export default {

        data() {
            return {
                events: [],
            }
        },

        computed: {
            showEvent: function () {
                return this.events.filter(event => event.id == this.$route.params.id)
            }
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },
            formatedTime (time) {
                return moment(time, "HH:mm").format('LT');
            }
        },

        created() {
            axios.get('http://localhost/Projet5/public/eventsList')
            .then(response => this.events = response.data)
            .catch(error => console.log(error));
        },

        mounted() {
            console.log(this.$route.params.id)
        }

}
</script>

<style>

</style>
