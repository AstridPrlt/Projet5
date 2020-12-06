<template>
    <div class="w-100">
        <div>
            <form id="payment-form" @submit.prevent="payment" class="rounded">
                <div id="card-element" class="p-2" style="background-color: #eae9e9;"><!-- Stripe.js injects the Card Element via elements --></div>

                <div id="card-errors" role="alert"><!-- error messages injected in this element --></div>

                <button type="submit" class="btn btn-perso w-100 rounded-0" id="submit">
                    <div v-show="spinner" class="spinner-border text-light" role="status" id="spinner">
                        <span class="sr-only">Paiement en cours...</span>
                    </div>
                    <span v-show="!spinner" id="button-text">Payer {{ priceToPay }} €</span>
                </button>
            </form>
        </div>
    </div>

</template>

<script>

export default {
    props: ['eventToPay', 'priceToPay'],

    data() {
        return {
            stripe: '',
            elements: '',
            card: '',

            spinner: false
        }
    },

    mounted() {
        this.stripe = Stripe('pk_test_51HpeMXDt6vNlBQPr1P02aQ1zmAbqgcLrAveNgJYfV7e8YpvjaqySzlMpWulgMDTFNntaJvrAuNRogO8YIsL1ejNE004yjHml0m');
        this.elements = this.stripe.elements();

        var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
        };

        this.card = this.elements.create("card", { style: style });
        this.card.mount("#card-element");

        this.card.on('change', ({error}) => {
            let displayError = document.getElementById('card-errors');
            if (error) {
                displayError.classList.add('alert', 'alert-warning');
                displayError.textContent = error.message;
            } else {
                displayError.classList.remove('alert', 'alert-warning');
                displayError.textContent = '';
            }
        });

    },

    methods: {

        payment() {
            this.spinner = true;
            axios.post('https://lecowee.astrid-perillat.fr/inscription/' + this.eventToPay + '/paiement', {
                price: this.priceToPay }) //retrieve the client_secret
            .then((response) => {
                // console.log(response);
                this.stripe.confirmCardPayment(response.data, { //send the client_secret to Stripe with info
                    payment_method: {
                        card: this.card,
                    },

                }).then((result) => {
                    // console.log(result);
                    if (result.error) {// Show error to user (e.g., insufficient funds)
                        // console.log(result.error.message);
                        document.getElementById('card-errors').classList.add('alert', 'alert-warning');
                        document.getElementById('card-errors').textContent = result.error.message;
                    } else {// The payment has been processed!
                        if (result.paymentIntent.status === 'succeeded') {
                            document.getElementById('payment-form').remove();
                            this.$emit('payment-made', { pi: result.paymentIntent.id, eventId: this.eventToPay });

                        }
                    }
                });
                this.spinner = false
            })
            .catch((error) => {
                // console.log(error);
                alert("Le paiement n'a pas pu être effectué");
                this.spinner = false;
                this.$emit('payment-error')
            });
        },

    }

}
</script>
