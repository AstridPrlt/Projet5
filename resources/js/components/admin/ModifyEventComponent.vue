<template>
    <div>
        <div class="modal fade" :id="`modifyEventModal${eventToModify.id}`" tabindex="-1" aria-labelledby="modifyEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyEventModalLabel">Evènement à modifier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form ref="modifyEventForm" method="post" @submit.prevent="updateEvents">

                            <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">Catégorie</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="category" v-model="eventToModify.category" required>
                                        <option>Réseau</option>
                                        <option>Compétences</option>
                                        <option>Business</option>
                                        <option>Détente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">Titre</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="title" v-model="eventToModify.title" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="eventDate" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9"><input type="date" id="eventDate" name="EventDate" class="form-control w-auto" v-model="eventToModify.event_date" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="eventDate" class="col-sm-3 col-form-label">Heure</label>
                                <div class="col-sm-9 d-flex">
                                    <label for="begin"></label><input type="time" id="begin" name="begin" class="form-control w-auto" v-model="eventToModify.begin_time" required>
                                    <label for="end" class="mx-3"> à </label><input type="time" id="end" name="end" class="form-control w-auto" v-model="eventToModify.end_time" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="description" rows="5" placeholder="Description..." v-model="eventToModify.event_description" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="seats" class="col-sm-3 col-form-label">Nombre de places </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" id="seats" max="200" v-model="eventToModify.seats" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label">Prix </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" id="price" max="2000" v-model="eventToModify.price" required></div>
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

    props: ['eventToModify'],

    data() {
        return {
            spinner: false,
        }
    },

    methods: {

        updateEvents() {
            this.spinner = true;
            axios.patch('http://localhost/Projet5/public/events/' + this.eventToModify.id, {
                category: this.eventToModify.category,
                title: this.eventToModify.title,
                event_date: this.eventToModify.event_date,
                begin_time: this.eventToModify.begin_time,
                end_time: this.eventToModify.end_time,
                event_description: this.eventToModify.event_description,
                seats: this.eventToModify.seats,
                price: this.eventToModify.price
            })
            .then((response) => {
                console.log(response);
                this.spinner = false;
                alert("L'évènement a bien été modifié")
                })
            .catch(error => console.log(error))
        }

    }

}
</script>
