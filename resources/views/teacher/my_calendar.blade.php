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
                <h5>{{$title}}</h5>
    </div>
    <div class="p-2"  id='calendar'></div>
 </div>
@endsection
@section('javascript')
<script src="{{asset('assets/fullcalendar/index.global.js')}}"></script>
<script>
  var events = new Array();
    @foreach ($classTimetable as $value)
                    events.push({
                    title: 'Lịch dạy: {{$value->class_name}} - {{$value->subject_name}}',
                    daysOfWeek: [{{$value->week_fullcalendar_day}}],
                    startTime: '{{ $value->start_time }}',
                    endTime: '{{ $value->end_time }}',
                    });
    @endforeach

    @foreach ($examTimetable as $exam)
        events.push({
                title: 'Kì thi: {{ $exam->class_name }} - {{ $exam->exam_name }} - {{ $exam->subject_name }} - ( {{ date( 'h:i A', strtotime($exam->start_time)) }}  to  {{ date( 'h:i A', strtotime($exam->end_time)) }} )',
                start: '{{ $exam->exam_date }}',
                end: '{{ $exam->exam_date }}',
                color:'green',
                url: '{{route('teachers.exam_timetable')}}'
        });
    @endforeach
  var calendarId = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarId, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
    },
    timeZone: 'Asia/Ho_Chi_Minh',
    initialDate: '<?= Date('Y-m-d') ?>',
    navLinks: true,
    editable: false,
    events: events,
    initialView: 'timeGridWeek',
  });
  calendar.render();
</script>
@endsection
