<template>
    <div>
        <form ref="eventForm">
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Catégorie</label>
                <div class="col-sm-10">
                    <select class="form-control" id="category" v-model="category">
                        <option>Réseau</option>
                        <option>Compétences</option>
                        <option>Business</option>
                        <option>Détente</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Titre</label>
                <div class="col-sm-10"><input type="text" class="form-control" id="title" v-model="title" required></div>
            </div>
            <div class="form-group row">
                <label for="eventDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10"><input type="date" id="eventDate" name="EventDate" class="form-control w-auto" v-model="event_date" required></div>
            </div>
            <div class="form-group row">
                <label for="eventDate" class="col-sm-2 col-form-label">Heure</label>
                <div class="col-sm-10 d-flex">
                    <label for="begin"></label><input type="time" id="begin" name="begin" class="form-control w-auto" v-model="begin_time" required>
                    <label for="end" class="mx-3"> à </label><input type="time" id="end" name="end" class="form-control w-auto" v-model="end_time" required>
                </div>
            </div>
              <div class="form-group">
                <textarea class="form-control" id="description" rows="8" placeholder="Description..." v-model="event_description" required></textarea>
            </div>
            <div class="form-group row">
                <label for="seats" class="col-sm-2 col-form-label">Nombre de places </label>
                <div class="col-sm-10"><input type="number" class="form-control w-auto" id="seats" max="200" v-model="seats" required></div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Prix </label>
                <div class="col-sm-10"><input type="number" class="form-control w-auto" id="price" max="2000" v-model="price" required></div>
            </div>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choisir une photo... Dimensions conseillées : 300 x 200</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                </div>
            </div>

            <button type="submit" class="btn btn-perso my-3" @click="submitEvent">Créer</button>
            <div v-show="spinner" class="spinner-border text-secondary" role="status">
                <span class="sr-only">Création en cours...</span>
            </div>
        </form>
    </div>
</template>

<script>
export default {

    data () {
        return {
                category: '',
                title: '',
                event_date: '',
                begin_time: '',
                end_time: '',
                event_description: '',
                seats: '',
                price: '',
                picture: '',
                spinner: false
        }
    },

    methods: {
        submitEvent() {
            this.spinner = true;
            axios.post('http://localhost/Projet5/public/eventCreation', {
                title: this.title,
                event_date: this.event_date,
                begin_time: this.begin_time,
                end_time: this.end_time,
                event_description: this.event_description,
                seats: this.seats,
                price: this.price
            })
            .then((response) => {
                console.log(response);
                this.$refs.eventForm.reset();
            })
            .catch(error => console.log(error));
        }
    },

}
</script>
