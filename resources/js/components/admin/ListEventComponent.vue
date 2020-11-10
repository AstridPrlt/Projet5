<template>
    <div>
        <div class="modal fade" :id="`listEventModal${eventId}`" tabindex="-1" aria-labelledby="listEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="listEventModalLabel">Liste des participants</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div v-for="people in listEvent" :key="people.id">
                                <p>{{ people.name }} / {{ people.email }}</p>
                            </div>
                            <div v-if="listEvent.length === 0">
                                <p>Il n'y a aucun inscrit pour le moment</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['eventId'],

    data() {
        return {
            listEvent: []
        }
    },

    created() {
        axios.get('http://localhost/Projet5/public/events/list/' + this.eventId)
        .then(response => this.listEvent = response.data)
        .catch(error => console.log(error));
    }

}
</script>
