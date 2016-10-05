

$(document).ready(function() {
        var date = new Date(2016, 10, 10);
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#button_create').click(function() { //creates new event
            var newEvent = {
                title: 'NEW EVENT',
                start: new Date(y, m, d)
            };
            $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');
        });

        $('#button_view').click(function() { //changes viewType
            var view = $('#calendar').fullCalendar('getView');
            if (view.name == 'month') {
                $('#calendar').fullCalendar( 'changeView','agendaWeek');
            } else {
                $('#calendar').fullCalendar( 'changeView','month');
            }
        });

        var newEvent = {
            title: 'MATH135 Midterm',
            start: new Date(2016, 09, 03),
    		color: 'yellow',   // an option!
    		textColor: 'black' // an option!
        };

        function checkTime(time){ //checks whether given time is in valid format
            re = /^\d{1,2}:\d{2}([ap]m)?$/; //regular expression to match required format
            if(time != '' && !time.match(re)) {
                alert("Invalid time format: " + time);
                time = prompt('Event Time: ')
                return false;
            } else {
                return true;
            }
        }

	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
	        theme: true,
	        height: $(window).height(),
	        editable: true,
	        events: "application/jsonMySQL.php",

            dayClick: function(date, allDay, jsEvent, view) { //onclick event creation
                window.alert(date);
                var title = prompt('Event Title:');
                var time = prompt('Event Time: ')

                while (!(checkTime(time))){ //if time is not valid, prompt again
                    time = prompt('Invalid input. Event Time: ')
                }

                //todo: implement time into newEvent date 
                var newEvent = {
                    title: title,
                    start: date
                };
                $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');
            }
    	})
    });