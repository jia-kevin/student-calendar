

$(document).ready(function() {

        $('#button_view').click(function() { //changes viewType 
            var view = $('#calendar').fullCalendar('getView');
            if (view.name == 'month') {
                $('#calendar').fullCalendar( 'changeView','agendaWeek');
            } else {
                $('#calendar').fullCalendar( 'changeView','month');
            }
        });

    
        function getTime(defaultTime, myTime){
            defaultTime.time(myTime);
            return defaultTime;
        } 

        //playing around, delete if useless
        function callPHP(title, start, end){
            var httpc = new XMLHttpRequest();
            var url = "eventToSQL.php"
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "text/xml");
            httpc.send(title);
        }
        //

//getting mysql data from php using ajax
        function getPHP() {
             $.ajax({ type: "GET",   
                     url: "eventFromSQL.php",   
                     async: false,
                     success : function(text)
                    {
                     response = text;
                    }
            });
            vex.dialog.alert(response);
        }
// to be removed


	    $('#calendar').fullCalendar({
	        // put your options and callbacks here

            header: {
                left: 'prev, next, today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
	        theme: true,
	        height: $(window).height() * 0.95,
	        editable: true,
            droppable: true,
	        events: "application/eventFromSQL.php",
            
            eventClick: function(calEvent, jsEvent, view){
               vex.dialog.alert('Event: ' + calEvent.title);
            },

            //https://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
            eventReceive: function(event){
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
                $('#calendar').fullCalendar('updateEvent',event);
            },
            //

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
