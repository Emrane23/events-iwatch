<template>

<div class="row justify-content-center">
    <div class="col-md-6 text-center mb-4 mt-5">
      <h2 class="heading-section">Calendrier</h2>
      <breadcrumb-component item_nav="Calendrier"></breadcrumb-component>
    </div>
  </div>
  <div class="card shadow sm mb-5" >
      <FullCalendar class="comp-full-calendar" :options="calendarOptions" />
  </div>
</template>
<script>
// import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin,listPlugin,timeGridPlugin ],
        initialView: 'dayGridMonth',
        headerToolbar:{
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay,listDay'
        },
        editable:true,
        selectable:true,
        weekends: true
      }
    }
  }
}
</script>
<style>
.comp-full-calendar{
    width: auto !important;
  }
</style>