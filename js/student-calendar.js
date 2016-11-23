$(document).ready(function() {


    function getTime(defaultTime, myTime){
        defaultTime.time(myTime);
        return defaultTime;
    } 

    function getEvents() {
        var obj;
        $.ajax({
            url: '/eventToSQL.php',
            type: 'POST',
            data: 'type=fetch',

            async: false,
            success: function(response){
                obj = response;
            }
        });
        return obj;
    }

    function sendEvent(event) {
        var title = event.title;
        var start = event.start;
        alert(event.title);
        alert(event.start);
        $.ajax({
            url: '/eventToSQL.php',
            data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
            type: 'POST',
            dataType: 'json',
            success: function(response){
                event.id = response.eventid;
                alert(event.id);
            },

            error: function(e){
                alert("error");
                console.log(e.responseText);
            }
       });
    }

    function deleteEvent(event) {
        var id = event.id;
        $.ajax({
            url: '/eventToSQL.php',
            type: 'POST',
            data: 'type=delete&id='+id,
            dataType: 'json',
            success: function(response){
                alert(response);
            }
       });
    }

    
    var zone = "05:00"; //adding location timezone, to be modified
    $('#calendar').fullCalendar({
        //options and callbacks

        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },

        theme: true,
        height: $(window).height() * 0.95,
        editable: true,
        droppable: true,
        events: JSON.parse(getEvents()),
        
        eventClick: function(calEvent, jsEvent, view){
            var MM = {Jan:"January", Feb:"February", Mar:"March", Apr:"April", May:"May", Jun:"June", Jul:"July", Aug:"August", Sep:"September", Oct:"October", Nov:"November", Dec:"December"};

            var stime = String(new Date(calEvent.start.format())).replace(
                /\w{3} (\w{3}) (\d{2}) (\d{4}) (\d{2}):(\d{2}):[^(]+\(([A-Z]{3})\)/,
                function($0,$1,$2,$3,$4,$5,$6){
                    return MM[$1]+" "+$2+", "+$3+" - "+$4%12+":"+$5+(+$4>12?"PM":"AM")+" "+$6 
                }
            );

            var etime;
            if (calEvent.end != undefined) {
                etime = String(new Date(calEvent.end.format())).replace(
                    /\w{3} (\w{3}) (\d{2}) (\d{4}) (\d{2}):(\d{2}):[^(]+\(([A-Z]{3})\)/,
                    function($0,$1,$2,$3,$4,$5,$6){
                        return MM[$1]+" "+$2+", "+$3+" - "+$4%12+":"+$5+(+$4>12?"PM":"AM")+" "+$6 
                    }
                );
            }

            var message = 'Event: ' + calEvent.title + 
                            '<br> Start Time: ' + stime;
            if (calEvent.end != undefined) {
                message += '<br> End Time: ' + stime;
            }

            alert(message);
            vex.dialog.buttons.YES.text = 'Delete';
            vex.dialog.buttons.NO.text = 'Ok';
            vex.dialog.open({
                unsafeMessage: message,
                input: [
                    '<style>',
                        '.vex-custom-field-wrapper {',
                            'margin: 1em 0;',
                        '}',
                        '.vex-custom-field-wrapper > label {',
                            'display: inline-block;',
                            'margin-bottom: .2em;',
                        '}',
                    '</style>'
                ].join(''),
                callback: function(value) {
                    if (value) {
                        alert("deleting");
                        $('#calendar').fullCalendar('removeEvents' , calEvent.id);
                        deleteEvent(calEvent);
                        $('#calendar').fullCalendar('refetchEvents');
                    }
                }
            });
        },


        dayClick: function(date, allDay, jsEvent, view) { //onclick event creation
            getTime(date, date);
            
            vex.dialog.buttons.YES.text = 'Ok';
            vex.dialog.buttons.NO.text = 'Cancel';
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
                    title: title,
                    allDay: data.allDay,
                    start: getTime(date, data.stime).format(),
                    end: getTime(date, data.etime).format()
                }
              //  alert(newEvent.start.format("YYYY-MM-DD[T]HH:MM:SS"));
                sendEvent(newEvent);
                $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');
            }   
            })
        }


	})
});
