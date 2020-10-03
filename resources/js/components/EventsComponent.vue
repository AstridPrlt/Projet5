<template>
    <div class="d-flex">
        <div v-for="event in events" :key="event.id" class="card" style="width: 22%; margin: 1.5%;">
            <img :src="`./../public/images/events/${ event.event_picture }`" class="card-img-top" :alt="`${ event.title }`">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">{{ event.title }}</h5>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Le {{ formatedDate(event.event_date) }}</li>
                    <li class="list-group-item">De {{ formatedTime(event.begin_time) }} à {{ formatedTime(event.end_time) }}</li>
                    <li class="list-group-item">{{ event.price }} €</li>
                </ul>
            <div class="card-body">
                <button type="button" class="btn btn-perso2" data-toggle="modal" :data-target="`#eventModal${ event.id }`">Détails</button>
                <button type="button" class="btn btn-perso" data-toggle="modal" :data-target="`#eventModal${ event.id }`">Je m'inscris !</button>
            </div>


            <div class="modal fade" :id="`eventModal${ event.id }`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ event.title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">{{ event.event_description }}</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-perso">Je m'inscris !</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
  import moment from 'moment';
  moment.locale('fr');


    export default {

        props: ['events'],

        methods: {
            formatedDate (date) {
                return moment(date).format('ll');
            },
            formatedTime (time) {
                return moment(time, "HH:mm").format('LT');
            }
        },

        mounted() {
            console.log(this.events)
    }

}
</script>

