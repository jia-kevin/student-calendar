

$(document).ready(function() {
        // var date = new Date(2016, 10, 10);
        // var d = date.getDate();
        // var m = date.getMonth();
        // var y = date.getFullYear();

        // // $('#button_create').click(function() { //creates new event on button click
        // //     var newEvent = {
        // //         title: 'NEW EVENT',
        // //         start: new Date(y, m, d)
        // //     };
        // //     $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');
        // // });

        $('#button_view').click(function() { //changes viewType 
            var view = $('#calendar').fullCalendar('getView');
            if (view.name == 'month') {
                $('#calendar').fullCalendar( 'changeView','agendaWeek');
            } else {
                $('#calendar').fullCalendar( 'changeView','month');
            }
        });


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
               vex.dialog.open({
                input: [
                    '<label for="text">Event Name:</label>',
                    '<input name="name" type="text" value="" />',
                    '<label for="date">Time</label>',
                        '<input name="time" type="time" value="" />',
                ].join(''),
                callback: function (data) {
                    if (!data) {
                        return console.log('Cancelled')
                    }
                    var title = data.name;
                    var datetime = date;
                    var newEvent = {
                        title:title,
                        start: datetime //need to manipulate datetime to implement inputted time
                    }
                    $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');

                }   
                })
                
            }
    	})
    });
