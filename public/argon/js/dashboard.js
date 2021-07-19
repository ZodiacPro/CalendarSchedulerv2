$(document).ready(function(){
$('#alert').hide();

var today_month = moment().format('MMMM');
var today_year = moment().format('YYYY');

$('.monthtext').val(today_month);
$('.year').val(today_year);


$('#slctyear').change(function(e){
    $('.year').val($('#slctyear').val());
    $('.day_area').remove();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = {
        month: $('#slctmonth').val(),
        year: $('#slctyear').val(),
    };
    $.ajax({
        type: 'GET',
        url: '/getCalendar',
        data: formData,
        dataType: 'json',
        success: function (data) {
            $el = '';
            for($y = 1; $y <= data.skip; $y ++){
                $el = $el + ' <li class="day_area"></li>';
            }
            for($x = 1; $x <= data.number_of_days; $x ++){
                $el = $el + '<li class="day_area"><div class="card"><div class="card-header">'+$x+'</div><div class="card-body">';
                data.taskdata.forEach(function(item) {
                    $start_date = new Date(item.start_date + "Z"),
                    $end_date = new Date(item.end_date + "Z"),
                    $loop_date = new Date(data.yearmonth + $x + "Z")
                    if($start_date <= $loop_date && $end_date >= $loop_date){
                        $el = $el + '<h6 style="background-color: '+item.color+'" data-toggle="tooltip" data-placement="top" title="'+item.description+'">'+item.name+'<br></h6>';
                    }                         
                });
                $el = $el + '</div></div></li>';
            
                
               
            }
            $('.days').append($el);
        },
        error: function (data) {
            
        }
    });
});

$('#slctmonth').change(function(e){
    $('#alert').hide();
    $('.monthtext').val($("#slctmonth option:selected" ).text());
    $('.day_area').remove();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = {
        month: $('#slctmonth').val(),
        year: $('#slctyear').val(),
    };
    $.ajax({
        type: 'GET',
        url: '/getCalendar',
        data: formData,
        dataType: 'json',
        success: function (data) {
            $el = '';
            for($y = 1; $y <= data.skip; $y ++){
                $el = $el + ' <li class="day_area"></li>';
            }
            for($x = 1; $x <= data.number_of_days; $x ++){
                $el = $el + '<li class="day_area"><div class="card"><div class="card-header">'+$x+'</div><div class="card-body">';
                data.taskdata.forEach(function(item) {
                    $start_date = new Date(item.start_date + "Z"),
                    $end_date = new Date(item.end_date + "Z"),
                    $loop_date = new Date(data.yearmonth + $x + "Z")
                    if($start_date <= $loop_date && $end_date >= $loop_date){
                        $el = $el + '<h6 style="background-color: '+item.color+'" data-toggle="tooltip" data-placement="top" title="'+item.description+'">'+item.name+'<br></h6>';
                    }                         
                });
                $el = $el + '</div></div></li>';
            
                
               
            }
            $('.days').append($el);
        },
        error: function (data) {
            
        }
    });
});



$('#clipicon').hover(function(){
    $('#alert').hide();
    $("#clipicon").toggleClass('fa-clipboard fa-check');
    $("#clipdiv").toggleClass('bg-yellow bg-green');
});

$('#clipicon').click(function(e){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = {
        name: $('#name').val(),
        desc: $('#description').val(),
        from: $('#from').val(),
        to: $('#to').val(),
        creator_id: $('#creator_id').val(),
    };
    $.ajax({
        type: 'put',
        url: '/addTask',
        data: formData,
        dataType: 'json',
        success: function (data) {
            $('#name').val('');
            $('#description').val('');
            $('#from').val('');
            $('#to').val('');

        
        },
        error: function (data) {
            $('#name').val('');
            $('#description').val('');
            $('#from').val('');
            $('#to').val('');
        }
});
});


    
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#tasks').DataTable({
       processing: true,
       serverSide: true,
       ajax: {
        url: "/home",
        type: 'GET',
       },
       columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {data: 'action', name: 'action', orderable: false},
             ],
    });

});
