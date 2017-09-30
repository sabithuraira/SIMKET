<style>
    @import url('<?php echo Yii::app()->theme->baseUrl.'/dist/css/jadwal.css';?>');
</style>
<?php $this->pageTitle=Yii::app()->name; ?>
<div id="icontop-container">
<?php  
if(!Yii::app()->user->isGuest){
    if(Yii::app()->user->isKabupaten()==0){
        $this->menu=array(
            array('label'=>'<i class="icon-th-add"></i>  Tambah Kegiatan Baru', 'url'=>array('kegiatan/create')),
        );
    }
}
?>
<?php //echo CHtml::link("Tambah Kegiatan Baru",array('jadwal/create'));?>
</div>
<div style="clear: both;"></div>
<br />
<?php

$bb=array();
foreach($model as $i=>$ii)
{
    $bb[$i]=array('url'=>$this->createUrl('kegiatan/progress',
                array('id'=>$ii['id'])),$ii['id'],'title'=>$ii['kegiatan'],'start'=>date($ii['end_date']),
            'end'=>date($ii['end_date']),'allDay'=>false,'className'=>"eventColor".$ii->CalendarClass());
}
?>
<?php 

// $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget',
//     array(
//         'data'=>$bb,
//         'options'=>array(
//             'editable'=>false,
//             //'weekMode'=>'liquid',
//             //'weekends'=>true,
//             'firstDay'=>1,
//             'header'=>array(
//                 'right'=>'',//'month,agendaWeek,agendaDay',
//                 'left'=>'today prev,next',
//                 'center'=>'      title',
//             ),
//             'timeFormat'=>'',
//             'dayNames'=>array('Minggu', 'Senin', 'Selasa', 'Rabu',
//                         'Kamis', 'Jumat', 'Sabtu'),
//             'monthNames'=>array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
//                         'Agustus', 'September', 'Oktober', 'November', 'Desember'),
//             'columnFormat'=>array(
//                     'day'=>'dddd M/d',
//                     'month'=>'dddd',
//                     'week'=>'dddd, MMM dS',
//             ),
//         ),
//     )
// );
?>


<div class="box box-primary">
    <div class="box-body no-padding">
        <!-- THE CALENDAR -->
        <div id="calendar"></div>
    </div>
    <!-- /.box-body -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/fullcalendar/fullcalendar.min.js"></script>

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
        {
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: "#f56954", //red
          borderColor: "#f56954" //red
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2),
          backgroundColor: "#f39c12", //yellow
          borderColor: "#f39c12" //yellow
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: "#0073b7", //Blue
          borderColor: "#0073b7" //Blue
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: "#00c0ef", //Info (aqua)
          borderColor: "#00c0ef" //Info (aqua)
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/',
          backgroundColor: "#3c8dbc", //Primary (light-blue)
          borderColor: "#3c8dbc" //Primary (light-blue)
        }
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>