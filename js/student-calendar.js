

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

	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
	        theme: true,
	        height: $(window).height(),
	        editable: true,
	        events: "application/eventFromSQL.php",
            
            eventClick: function(calEvent, jsEvent, view){
               vex.dialog.alert('Event: ' + calEvent.title);
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
