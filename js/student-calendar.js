

$(document).ready(function() {

        $('#button_view').click(function() { //changes viewType 
            var view = $('#calendar').fullCalendar('getView');
            if (view.name == 'month') {
                $('#calendar').fullCalendar( 'changeView','agendaWeek');
            } else {
                $('#calendar').fullCalendar( 'changeView','month');
            }
        });


	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
	        theme: true,
	        height: $(window).height(),
	        editable: true,
	        events: "application/eventFromSQL.php",

            dayClick: function(date, allDay, jsEvent, view) { //onclick event creation
               vex.dialog.open({
                input: [
                    '<label for="text">Event Name:</label>',
                    '<input name="name" type="text" value="" />',
                    '<label for="start">Start Time</label>',
                        '<input name="stime" type="time" value="" />',
                    '<label for="end">End Time</label>',
                        '<input name="ftime" type="time" value="" />'
                ].join(''),
                callback: function (data) {
                    if (!data) {
                        return console.log('Cancelled')
                    }
                    var title = data.name;
                    var datetime = date;
                    var newEvent = {
                        title:title,
                        allDay: false,
                        start: datetime //need to manipulate datetime to implement inputted time
                    }
                    $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');

                }   
                })
                
            }
    	})
    });
