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

    //gets a list of all the classes
    function getClasses() {
        var obj;
        $.ajax({
            url: '/newclass.php',
            type: 'POST',
            data: 'type=getClasses',

            async: false,
            success: function(response){
                obj = response;
            }
        });
        return obj;
    }

    //returns the classes as a list of HTML inputs
    function getHTMLClasses(){
        var jclasses = jQuery.parseJSON(getClasses());
        var str = "<select id=\"test-dropdown\" onchange=\"choice1(this)\">";
        for (var c in jclasses) {
            if (jclasses.hasOwnProperty(c)){
                temp = ["<option value=", c, ">", jclasses[c], "</option>"].join('');
                str = str.concat(temp);
            }
        }
        str = str.concat("</select>");
        return str
    }

    function getClassID(className) {
        var classID;
        alert(className);
        $.ajax({
            url: '/newclass.php',
            type: 'POST',
            data: {type: 'classToID', argument: className},
            async: false,
            success: function(response){
                alert(response);
                classID = response;
            },
            error: function(e){
                alert('fuck');
            }
        });

        return classID;
    }

    function sendEvent(event) {
        var title = event.title;
        var start = event.start;
        var end   = event.end;
        var c = event.class;
        //alert(event.class);
        alert(event.title);
        alert(event.start);
        $.ajax({
            url: '/eventToSQL.php',
            data: 'type=new&title='+title+'&startdate='+start+'&enddate='+end+'&zone='+zone+'&class='+c,
            type: 'POST',
            dataType: 'json',
            success: function(response){
                event.id = response.eventid;
                //alert(event.id);
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
        aspectRatio: 1.2,
        editable: false,
        droppable: true,
        events: JSON.parse(getEvents()),
        eventClick: function(calEvent, jsEvent, view){
            var MM = {Jan:"January", Feb:"February", Mar:"March", Apr:"April", 
                      May:"May", Jun:"June", Jul:"July", Aug:"August", 
                      Sep:"September", Oct:"October", Nov:"November", Dec:"December"};

            var stime = String(calEvent.start.format("MMMM DD, YYYY - hh:mmA"));

            var etime;
            if (calEvent.end != undefined) {
                etime = String(calEvent.end.format("MMMM DD, YYYY - hh:mmA"));
            }

            var message = 'Event: ' + calEvent.title + 
                            '<br> Start Time: ' + stime;
            if (calEvent.end != undefined) {
                message += '<br> End Time: ' + etime;
            }
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
            //var s = getHTMLClasses(); uncomment if necessary
            vex.dialog.open({
                
                
            input: 
                '<label for="text">Event Name:</label>' +
                '<input name="name" type="text" value="" />' +
                '<label for="start">Start Time</label>' +
                    '<input name="stime" type="time" value="" />' +
                '<label for="end">End Time</label>' +
                    '<input name="etime" type="time" value="" />' +
                '<label for="class">Class</label><br>'+
                    '<input name="className" type="text" value="" />'+ // replace with s variable for dynamic dropdown
                '<br><label for="allDay">All day?</label><br>'+
                    '<input name="allDay" type="checkbox" />',
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
                    class: getClassID(data.className),
                    end: getTime(date, data.etime).format()
                }
              //  alert(newEvent.start.format("YYYY-MM-DD[T]HH:MM:SS"));
                sendEvent(newEvent);
                $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');
            }   
            });
        }


	})
});
