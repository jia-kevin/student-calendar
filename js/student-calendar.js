$(document).ready(function() {


    function getTime(defaultTime, myTime){
        defaultTime.time(myTime);
        return defaultTime;
    } 
    var json_events;
    //this ajax code preventing it from working
    $.ajax({
        url: 'js/eventToSQL.php',
        type: 'POST',
        data: 'type=fetch',
        async: false,
        success: function(response){
            alert(response);
            json_events = response;

        }
    });

    var zone = "05:30"; //adding location timezone, to be modified
    $('#calendar').fullCalendar({
        //options and callbacks

        events: JSON.parse(json_events),
        //^ to be uncommented when 'fetch' implementation is fixed

        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },

        theme: true,
        height: $(window).height() * 0.95,
        editable: true,
        droppable: true,
       // events: "application/eventFromSQL.php",
        
        eventClick: function(calEvent, jsEvent, view){
           vex.dialog.alert('Event: ' + calEvent.title);
        },

        //https://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
        eventRender: function(event){ //called after dayClick
            var title = event.title;
            var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
            $.ajax({
                url: 'eventToSQL.php',
                data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    event.id = response.eventid;
                    $('#calendar').fullCalendar('updateEvent',event);
                },
                error: function(e){
                    console.log(e.responseText);
                }
           });
        },


        dayClick: function(date, allDay, jsEvent, view) { //onclick event creation
            getTime(date, date);
            vex.dialog.open({
            input: [
                '<label for="text">Event Name:</label>',
                '<input name="name" type="text" value="" />',
                '<label for="start">Start Time</label>',
                    '<input name="stime" type="time" value="" />',
                '<label for="end">End Time</label>',
                    '<input name="etime" type="time" value="" />',
                '<label for="allDay">All day?</label>',
                    '<input name="allDay" type="checkbox" />'
            ].join(''),
            callback: function (data) {
                if (!data) {
                    return console.log('Cancelled')
                }

                var title = data.name;
                var datetime = date;
                var newEvent = {
                    title:title,
                    allDay: data.allDay,
                    start: getTime(date, data.stime).format(),
                    end: getTime(date, data.etime).format()
                }
                $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');

            }   
            })
        }


	})
});
