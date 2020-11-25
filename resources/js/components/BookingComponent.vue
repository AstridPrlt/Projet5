<template>
    <div>
        <div class="w-75 mx-auto my-4 d-flex flex-wrap">
            <img :src="`./../storage/${eventSelected.event_picture}`" class="d-none d-md-block w-25" style="object-fit: contain;" :alt="`${ eventSelected.title }`">

            <div class="w-75 m-auto text-center">
                <h2>{{ eventSelected.title }}</h2>
                <p>Le {{ formatedDate(eventSelected.event_date_time) }}</p>
                <p>à {{ formatedTime(eventSelected.event_date_time) }}</p>
                <p>Prix : {{ eventSelected.price }} €</p>
            </div>

            <p class="w-100 my-5" style="white-space: pre-line;">{{ eventSelected.event_description }}</p>

            <button v-show="!isBooked && !payment" type="submit" class="btn btn-perso" @click="eventBooking(eventSelected.id)">Je m'inscris</button>

            <payment-component v-show="payment" :event-to-pay="eventSelected.id" :price-to-pay="eventSelected.price" @payment-made="bookingOk" @payment-error="cancelBookingAfterError"></payment-component>

            <div v-show="isBooked && !payment" id="payment-made">
                <p v-show="!bookingCanceled" class="text-bold" style="color: teal; font-size: 1rem;">Vous êtes inscrit à cet évènement, rendez-vous le {{ formatedDate(eventSelected.event_date) }} !<br/>Retrouvez la liste de vos évènements dans <a :href="`home`"><u>votre profil</u></a></p>

                <button v-show="!bookingCanceled" type="button" class="btn btn-outline-perso" @click="cancelBooking">Annuler mon inscription</button>
                <p v-show="bookingCanceled" class="text-bold" style="color: teal; font-size: 1rem;">Votre inscription a bien été annulée.</p>
            </div>

            <div class="w-auto mx-auto my-3 p-1" style="color: darkgrey;">L'inscription est définitive, et ne peut donner lieu à aucun remboursement.</div>
        </div>

    </div>

</template>


<script>
import moment from 'moment';
moment.locale('fr');
import PaymentComponent from './PaymentComponent.vue';

export default {
  components: { PaymentComponent },

        props: ['eventSelected', 'booked'],

        data: function () {
            return {
                isBooked: this.booked, //to know if it's already booked by user
                payment: false,
                bookingCanceled: false
            }
        },

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },
            formatedTime (time) {
                return moment(time).format('LT');
            },

            paymentComponent() {
                this.payment = true;
                this.isBooked = true;
            },

            eventBooking(eventSelected) {
                axios.post('http://localhost/Projet5/public/eventBooking', {
                    eventId: eventSelected })
                .then(response => {
                    // this.isBooked = 1;
                    this.payment = true
                })
                .catch(error => alert("L'inscription n'a pas abouti"));
            },

            bookingOk(payload) {
                this.isBooked = 1;
                this.payment = false;
                axios.patch('http://localhost/Projet5/public/eventBooking/' + this.eventSelected.id, {
                    pi: payload.pi
                })
                .then(response => console.log(response))
                .catch(error => console.log(error, payload))
            },

            cancelBooking() {
                if(confirm("Etes vous sûr de vouloir annuler votre inscription à cet évènement ?")) {
                axios.delete('http://localhost/Projet5/public/eventBooking/' + this.eventSelected.id)
                .then((response) => {
                    console.log(response);
                    this.bookingCanceled = true;
                    })
                .catch(error => console.log(error));
                }
            },

            cancelBookingAfterError() {
                axios.delete('http://localhost/Projet5/public/eventBooking/' + this.eventSelected.id)
                .then(response => this.isBooked = 0)
                .catch(error => alert("L'inscription n'a pas abouti"));
            }
        },

}
</script>
