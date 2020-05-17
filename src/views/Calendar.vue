<template>
    <div>
        <full-calendar
                ref="calendar"
                :events="events"
                defaultView="month"
                :event-sources="eventSources"
                @event-selected="eventSelected"
                @event-created="eventCreated"
                @day-click="dayClick"
                :config="config"
        ></full-calendar>
    </div>

</template>
<script>
    import moment from 'moment';
    export default {
        name: 'Calendar',
        data: () => ({
            events: [
                {
                  id: 1,
                  title: 'event1',
                  start: moment().hours(12).minutes(0),
                },
                {
                  id: 2,
                  title: 'event2',
                  start: moment().add(-1, 'days'),
                  end: moment().add(1, 'days'),
                  allDay: true,
                },
                {
                  id: 3,
                  title: 'event3',
                  start: moment().add(2, 'days'),
                  end: moment().add(2, 'days').add(6, 'hours'),
                  allDay: false,
                },
                {
                  id: 4,
                  title: 'event 4',
                  start: moment().add(3, 'days'),
                  end: moment().add(3, 'days').add(3, 'hours')
                }
            ],
            eventSources: [
            ],
            config: {
                locale: 'ru',
            },


        }),
        mounted() {

            },
        methods: {
            eventSelected(){},
            eventCreated(){},
            dayClick(){}
        },
    }
</script>