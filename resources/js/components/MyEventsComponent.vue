<template>
    <div>
        <div v-for="myEvent in myEvents" :key="myEvent.id">
            <h5>{{ myEvent.title }}</h5>
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
