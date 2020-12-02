<template>
    <div>
        <div class="w-75 mx-auto my-4 d-flex flex-wrap">
            <img :src="`/storage/${eventSelected.event_picture}`" class="d-none d-md-block w-25" style="object-fit: contain;" :alt="`${ eventSelected.title }`">

            <div class="w-75 m-auto text-center">
                <h2>{{ eventSelected.title }}</h2>
                <p>Le {{ formatedDate(eventSelected.event_date_time) }}</p>
                <p>à {{ formatedTime(eventSelected.event_date_time) }}</p>
                <p>Prix : {{ eventSelected.price == 0 ? "Gratuit !" : eventSelected.price + " €" }}</p>
            </div>

            <p class="w-100 my-5" style="white-space: pre-line;">{{ eventSelected.event_description }}</p>

            <p v-show="bookingCanceled" class="text-bold w-100" style="color: teal; font-size: 1rem;">Votre inscription a bien été annulée.</p>

            <button v-show="!isBooked && !payment" type="submit" class="btn btn-perso" @click="eventBooking(eventSelected.id)">Je m'inscris</button>

            <payment-component v-show="payment" :event-to-pay="eventSelected.id" :price-to-pay="eventSelected.price" @payment-made="makeBooking"></payment-component>

            <div v-show="isBooked && !payment &&!bookingCanceled" id="payment-made">
                <p class="text-bold" style="color: teal; font-size: 1rem;">Vous êtes inscrit à cet évènement, rendez-vous le {{ formatedDate(eventSelected.event_date) }} !<br/>Retrouvez la liste de vos évènements dans <a :href="`home`"><u>votre profil</u></a></p>

                <button v-if="eventSelected.price == 0 && !bookingCanceled" type="button" class="btn btn-outline-perso" @click="cancelBooking">Annuler mon inscription</button>
            </div>

            <div v-if="!eventSelected.price == 0" class="w-100 my-3 p-1" style="color: darkgrey;">L'inscription est définitive, et ne peut donner lieu à aucun remboursement.</div>
        </div>

        <div v-show="spinner" class="position-absolute w-100 h-100 justify-content-center align-items-center bg-white" style="display: flex; top: 0; left: 0; opacity: 0.8; z-index: 5;">
            <div v-show="spinner" class="lds-ripple"><div></div><div></div></div>
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
                spinner: false,

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
                if (this.eventSelected.price == 0) {
                    this.spinner = true;
                    axios.post('https://lecowee.astrid-perillat.fr/eventBooking', {
                        eventId: eventSelected })
                    .then(response => {
                        this.isBooked = 1;
                        this.spinner = false;
                    })
                    .catch((error) => {
                        this.spinner = false;
                        alert("L'inscription n'a pas abouti");
                    });
                } else {
                    this.payment = true
                };
            },

            makeBooking(payload) {
                console.log(payload);
                this.spinner = true;
                this.payment = false;
                axios.post('https://lecowee.astrid-perillat.fr/eventBooking', {
                    eventId: payload.eventId,
                    pi: payload.pi
                })
                .then((response) => {
                    console.log(response);
                    this.spinner = false;
                    this.isBooked = 1;
                })
                .catch((error) => {
                    console.log(error, payload);
                    alert("Probleme avec l'inscription");
                    this.spinner = false
                })
            },

            cancelBooking() {
                this.spinner = true;
                if(confirm("Etes vous sûr de vouloir annuler votre inscription à cet évènement ?")) {
                axios.delete('https://lecowee.astrid-perillat.fr/eventBooking/' + this.eventSelected.id)
                .then((response) => {
                    console.log(response);
                    this.isBooked = 0;
                    this.bookingCanceled = true;
                    this.spinner = false
                    })
                .catch(error => console.log(error));
                }
            },
        },

}
</script>
