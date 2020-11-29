<template>
    <div class="d-flex flex-wrap">
        <div v-for="showFutureEvent in showFutureEvents" :key="showFutureEvent.id" class="card" style="min-width: 280px; width: 22%; margin: 20px auto;">
            <img :src="`./../public/storage/${showFutureEvent.event_picture}`" class="card-img-top" :alt="`${ showFutureEvent.title }`" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">{{ showFutureEvent.title }}</h5>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-check mr-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/><path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/></svg>
                        Le {{ formatedDate(showFutureEvent.event_date_time) }} à {{ formatedTime(showFutureEvent.event_date_time) }}<br>
                        <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock mr-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/><path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
                        De {{ formatedTime(showFutureEvent.begin_time) }} à {{ formatedTime(showFutureEvent.end_time) }} -->
                    </li>
                    <li class="list-group-item">
                        <svg width="1em" height="1.2em" viewBox="0 0 16 16" class="bi bi-cash mr-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M15 4H1v8h14V4zM1 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H1z"/><path d="M13 4a2 2 0 0 0 2 2V4h-2zM3 4a2 2 0 0 1-2 2V4h2zm10 8a2 2 0 0 1 2-2v2h-2zM3 12a2 2 0 0 0-2-2v2h2zm7-4a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg>
                        Prix : {{ showFutureEvent.price == 0 ? "Gratuit !" : showFutureEvent.price + " €" }}
                    </li>
                    <li class="list-group-item">
                        Places restantes : {{ showFutureEvent.seats - showFutureEvent.seats_booked }} / {{ showFutureEvent.seats }}
                    </li>
                </ul>
            <div v-if="!authEvents.includes(showFutureEvent.id)" class="card-body text-right">
                <button type="button" class="btn btn-perso2" data-toggle="modal" :data-target="`#eventModal${ showFutureEvent.id }`">Détails</button>
                <a type="button" class="btn btn-perso" :href="`inscription/${showFutureEvent.id}`">Je m'inscris !</a>
            </div>
            <div v-else class="card-body text-right">
                <button type="button" class="btn btn-perso2" data-toggle="modal" :data-target="`#eventModal${ showFutureEvent.id }`">Détails</button>
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check-circle-fill" style="color: teal;" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>


            <div class="modal fade" :id="`eventModal${ showFutureEvent.id }`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered h-75">
                    <div class="modal-content h-75">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ showFutureEvent.title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="white-space: pre-line;">{{ showFutureEvent.event_description }}</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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

        props: ['events', 'authEvents'],

        data() {
            return {
                showFutureEvents: this.events,
            }
        },

    //     computed: {
    //         showFutureEvents: function () {
    //             let filteredEvents = this.showEvents.filter(showEvent => new Date(showEvent.event_date_time) >= new Date());
    //             return filteredEvents;
    //     },
    // },

        methods: {
            // formatedDate (date) {
            //     return moment(date).format('ll');
            // },
            // formatedTime (time) {
            //     return moment(time, "HH:mm").format('LT');
            // },

            formatedDate(date) {
                return moment(date).format('ll');
            },
            formatedTime(time) {
                return moment(time).format('LT');
            }

        },

}
</script>

