$(document).ready(function () {

    $('#taskTable').on( 'dblclick', 'td', function (event) {
		console.log('asdasdf');
		let this_el = $(this);
        let old_val = this_el.html();
        this_el.html('<textarea>'+old_val+'</textarea>');
    });

    $('#taskTable').on( 'blur', 'textarea', function (event) {
		let this_el = $(this);
		let this_el_tr = this_el.closest('tr');
		console.log(this_el_tr);
		let old_val = this_el.val();
		this_el.closest('td').html(old_val);
		console.log(this_el_tr.find('td.task').html());
		console.log(this_el_tr.attr('data-id'));
		$.ajax({
			method: "post",
			url: "saveupdate.php",
			data: {
				task: this_el_tr.find('td.task').html(),
				id:this_el.closest('tr').attr('data-id')
			},
			success:function (data) {
				//data = JSON.parse(data);
				//if( data.status ) {
				//this_el.closest('tr').remove();
				//} else {
				//console.log(data.error);
				//}
			}
		});
	});

    $('#taskTable').on( 'click', '#delete', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();
        let this_el = $(this);
        $.ajax({
            method: "get",
            url: "delete.php",
            data: {
                del_task: this_el.attr('data-id')
            },
            success:function (data) {
                //data = JSON.parse(data);
                //if( data.status ) {
                    this_el.closest('tr').remove();
                //} else {
                    //console.log(data.error);
                //}
            }
        })
    });


    $('#taskForm').submit( function (event) {
        event.preventDefault();
        $.ajax({
            method: "post",
            url: "/add.php",
            data: {
                'task_input': $('#task_input').val(),
                },
            success:function (data) {
                console.log('-----',data);
                //data = JSON.parse(data);
                // if( data.status ) {
                //     $('#taskTable').append(
                //         '<tr> \
                //         <td>' + data.task + '</td> \
                //     <td><a id="delete" data-id="'+data.id+'" href="#">Х</a> </td> \
                //     </tr>'
                //     );
                //     $('#task_input').val('');
                // } else {
                //     console.log(data.error);
                // }
            }
        })

    });
});


