<template>
    <div>
        <div v-for="myEvent in myEvents" :key="myEvent.id" class="d-flex justify-content-between py-1">
            <h5>{{ myEvent.title }}</h5>
            <a type="button" class="btn btn-perso py-1" :href="`inscription/${myEvent.id}`">Détails</a>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            myEvents: {}
        }
    },

    created() {
        axios.get('http://localhost/Projet5/public/myEvents')
        .then(response => this.myEvents = response.data)
        .catch(error => console.log(error));
    },

}
</script>
