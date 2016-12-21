function inClass(checkClass) {
    var result;
    $.ajax({
        url: '/newclass.php',
        type: 'POST',
        data: 'type=inClass&class='+checkClass,

        async: false,
        success: function(response){
            result = response;
        }
    });
    return result;
}

function classExists(checkClass) {
    var result;
    $.ajax({
        url: '/newclass.php',
        type: 'POST',
        data: 'type=classExists&class='+checkClass,

        async: false,
        //dataType: 'boolean', 
        success: function(response){
            result = response;
        }
    });
    alert(result);
    return result;
}
function newClass(checkClass) {
    var result;
    $.ajax({
        url: '/newclass.php',
        type: 'POST',
        data: 'type=newClass&class='+checkClass,
    });
}
function joinClass(checkClass) {
    $.ajax({
        url: '/newclass.php',
        type: 'POST',
        data: 'type=joinClass&class='+checkClass,
    });
}

function joinClassPrompt() {
	vex.dialog.buttons.YES.text = 'Join';
    vex.dialog.buttons.NO.text = 'Cancel';
    vex.dialog.open({
		input: [
		    '<label for="text">Group Name:</label>',
		    '<input name="name" type="text" value="" />',
		].join(''),
		callback: function (data) {
            if (!data) {
                return console.log('Cancelled')
            }

	    	if (classExists(data.name) && !inClass(data.name))
	    		joinClass(data.name);
	    }
	});
}

function createClassPrompt() {
	vex.dialog.buttons.YES.text = 'Create';
    vex.dialog.buttons.NO.text = 'Cancel';
    vex.dialog.open({
		input: [
		    '<label for="text">Group Name:</label>',
		    '<input name="name" type="text" value="" />',
		].join(''),
		callback: function (data) {
            if (!data) {
                return console.log('Cancelled')
            }

	    	if (!classExists(data.name))
	    		newClass(data.name)
	    }
	});
}