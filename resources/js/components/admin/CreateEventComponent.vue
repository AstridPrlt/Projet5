<template>
    <div>
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Nouvel évènement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancelCreationEvent">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form ref="eventForm" method="post" @submit.prevent="submitEvent" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">Catégorie</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="category" v-model="category" required>
                                        <option>Réseau</option>
                                        <option>Compétences</option>
                                        <option>Business</option>
                                        <option>Détente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">Titre</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="title" v-model="title" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="eventDate" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9"><input type="date" id="eventDate" name="EventDate" class="form-control w-auto" v-model="event_date" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="eventDate" class="col-sm-3 col-form-label">Heure</label>
                                <div class="col-sm-9 d-flex">
                                    <label for="begin"></label><input type="time" id="begin" name="begin" class="form-control w-auto" v-model="begin_time" required>
                                    <label for="end" class="mx-3"> à </label><input type="time" id="end" name="end" class="form-control w-auto" v-model="end_time" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="description" rows="8" placeholder="Description..." v-model="event_description" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="seats" class="col-sm-3 col-form-label">Nombre de places </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" id="seats" max="200" v-model="seats" required></div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label">Prix </label>
                                <div class="col-sm-9"><input type="number" class="form-control w-auto" id="price" max="2000" v-model="price" required></div>
                            </div>
                            <div class="input-group flex-column">
                                <div class="custom-file w-100">
                                    <input type="file" class="custom-file-input" id="custom-file" aria-describedby="inputGroupFileAddon01" @change="showPreview">
                                    <label class="custom-file-label" for="custom-file" data-browse="Parcourir">Photo</label>
                                </div>
                                <small>Dimensions conseillées : 300 x 200</small>
                                <img v-show="showPicturePreview" :src="picturePreview" class="img-thumbnail" style="width: 150px; height: 100px;">
                            </div>

                            <button type="button" class="btn btn-outline-perso mx-2" data-dismiss="modal" aria-label="Close" @click="cancelCreationEvent">Annuler</button>
                            <button type="submit" class="btn btn-perso my-3">Créer</button>
                            <div v-show="spinner" class="spinner-border text-secondary align-middle" role="status">
                                <span class="sr-only">Création en cours...</span>
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
                event_picture: '',

                spinner: false,
                picturePreview: '',
                showPicturePreview: false,
        }
    },

    methods: {

        showPreview(event) {
            this.event_picture = event.target.files[0];
            let preview  = new FileReader();
            preview.readAsDataURL(this.event_picture);
            preview.onload = event => {
                this.showPicturePreview = true;
                this.picturePreview = event.target.result;
        }},

        cancelCreationEvent() {
                this.category = '';
                this.title = '';
                this.event_date = '';
                this.begin_time = '';
                this.end_time = '';
                this.event_description = '';
                this.seats = '';
                this.price = '';
                this.event_picture = '';
                this.spinner = false;
                this.picturePreview = '';
                this.showPicturePreview = false;
                this.$refs.eventForm.reset(); //reset the form not to have validation error messages
        },

        submitEvent() {
            // if(this.title && this.event_date) {
            this.spinner = true;
            // };
            let formData = new FormData();
            // avatarData.append('avatar', this.avatarImage);
            formData.append('category', this.category);
            formData.append('title', this.title);
            formData.append('event_date', this.event_date);
            formData.append('begin_time', this.begin_time);
            formData.append('end_time', this.end_time);
            formData.append('event_description', this.event_description);
            formData.append('seats', this.seats);
            formData.append('price', this.price);
            formData.append('picture', this.event_picture);
            console.log(this.event_picture);
            console.log(formData);
            axios.post('http://localhost/Projet5/public/eventCreation', formData)
            .then((response) => {
                console.log(response);
                this.cancelCreationEvent();
            })
            .catch(error => console.log(error));
        }
    },

}
</script>
