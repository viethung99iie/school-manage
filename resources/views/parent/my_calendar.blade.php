@extends('layouts.app')
@section('title')
{{$title}}
@endsection
<style>
.fc-daygrid-event {
    white-space: normal;
}
</style>
@section('content')
 <div class="card py-2">
    <div class="card-header pb-0" >
                <h6>{{$title}}</h6>
    </div>
    <div class="p-2"  id='calendar'></div>
 </div>
@endsection
@section('javascript')
<script src="{{asset('assets/fullcalendar/index.global.js')}}"></script>
<script>
  var events = new Array();
              @foreach ($getRecord as $value)
                @foreach ($value['weeks'] as $week)
                  events.push({
                    title: '{{$value['name']}}',
                    daysOfWeek: [{{$week['fullcalendar_day']}}],
                    startTime: '{{ $week['start_time'] }}', // Add startTime property
                    endTime: '{{ $week['end_time'] }}', // Add endTime property
                  });
                @endforeach
              @endforeach

   @foreach ($examTime as $valueE)
    @foreach ($valueE['exam'] as $exam)
      events.push({
        title: ' {{ $valueE['name'] }} {{ $exam['subject_name'] }} ( {{ date( 'h:i A', strtotime($exam['start_time'])) }}  to  {{ date( 'h:i A', strtotime($exam['end_time'])) }} )',
        start: '{{ $exam['exam_date'] }}',
        end: '{{ $exam['exam_date'] }}',
        color:'green',
        url: '{{route('students.exam_timetable')}}'
      });
    @endforeach
  @endforeach

  var calendarId = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarId, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
    },
    timeZone: 'Asia/Ho_Chi_Minh',
    minTime: '06:00:00',
    maxTime: '18:00:00',
    initialDate: '<?= Date('Y-m-d') ?>',
    navLinks: true,
    editable: false,
    events: events,
    initialView: 'timeGridWeek',
  });
  calendar.render();
</script>
@endsection
