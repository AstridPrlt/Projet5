<template>
    <div>
        <div class="modal fade" :id="`modifyEventModal${eventIdToModify}`" data-backdrop="static" tabindex="-1" aria-labelledby="modifyEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyEventModalLabel">Evènement à modifier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" @submit.prevent="updateEvents">

                            <div class="form-group row">
                                <label :for="`category${eventIdToModify}`" class="col-sm-3 col-form-label">Catégorie</label>
                                <div class="col-sm-9">
                                    <select class="form-control" :id="`category${eventIdToModify}`" v-model="eventToModify.category" required>
                                        <option>Réseau</option>
                                        <option>Compétences</option>
                                        <option>Business</option>
                                        <option>Détente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label :for="`title${eventIdToModify}`" class="col-sm-3 col-form-label">Titre</label>
                                <div class="col-sm-9"><input type="text" class="form-control" :id="`title${eventIdToModify}`" maxlength="60" minlength="2" v-model="eventToModify.title" required></div>
                            </div>
                            <div class="form-group row">
                                <label :for="`eventDate${eventIdToModify}`" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9"><input type="date" :id="`eventDate${eventIdToModify}`" name="eventDate" class="form-control w-auto" v-model="eventToModify.event_date" required></div>
                            </div>
                            <div class="form-group row">
                                <label :for="`begin${eventIdToModify}`" class="col-sm-3 col-form-label">Heure</label>
                                <div class="col-sm-9"><input type="time" :id="`begin${eventIdToModify}`" name="begin" class="form-control w-auto" v-model="eventToModify.begin_time" required></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" :id="`description${eventIdToModify}`" rows="5" placeholder="Description..." maxlength="500" minlength="2" v-model="eventToModify.event_description" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label :for="`seats${eventIdToModify}`" class="col-sm-3 col-form-label">Nombre de places </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" :id="`seats${eventIdToModify}`" max="200" v-model="eventToModify.seats" required></div>
                            </div>
                            <div class="form-group row">
                                <label :for="`price${eventIdToModify}`" class="col-sm-3 col-form-label">Prix </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" :id="`price${eventIdToModify}`" max="2000" v-model="eventToModify.price" required></div>
                            </div>

                            <button type="button" class="btn btn-outline-perso mx-2" data-dismiss="modal" aria-label="Close">Annuler</button>
                            <button type="submit" class="btn btn-perso my-3">Modifier</button>
                            <div v-show="spinner" class="spinner-border text-secondary align-middle" role="status">
                                <span class="sr-only">Modification en cours...</span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    props: ['eventIdToModify'],

    data() {
        return {
            spinner: false,
            eventToModify: {}
        }
    },

    created() {
        axios.get('https://lecowee.astrid-perillat.fr/modifyEvent/' + this.eventIdToModify)
        .then(response => this.eventToModify = response.data)
        .catch(error => console.log(error));
        },

    methods: {

        updateEvents() {
            this.spinner = true;
            axios.patch('https://lecowee.astrid-perillat.fr/events/' + this.eventIdToModify, {
                category: this.eventToModify.category,
                title: this.eventToModify.title,
                event_date: this.eventToModify.event_date,
                begin_time: this.eventToModify.begin_time,
                event_date_time: this.eventToModify.event_date + ' ' + this.eventToModify.begin_time,
                event_description: this.eventToModify.event_description,
                seats: this.eventToModify.seats,
                price: this.eventToModify.price
            })
            .then((response) => {
                console.log(response);
                this.spinner = false;
                alert("L'évènement a bien été modifié");
                this.$emit('event-updated', response);
                })
            .catch(error => console.log(error))
        }

    }

}
</script>
