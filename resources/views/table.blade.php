@extends('layout.main')

@section('content')

<script src="https://code.highcharts.com/highcharts.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


 <!-- DataTables Example -->
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('staffDeleteAll') }}">Delete All Selected</button>
                    <table class="table table-bordered" id="tableStaff" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="50px"><input type="checkbox" id="master"></th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($staff->count())
                            @foreach($staff as $s)
                                <tr id="tr_{{$s->id}}">
                                <td><input type="checkbox" class="sub_chk" data-id="{{$s->id}}"></td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->jabatan }}</td>
                                <td>{{ $s->umur }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>
                                    <a href="{{ url('staff',$s->id) }}" class="btn btn-danger btn-sm"
                                          data-tr="tr_{{$s->id}}"
                                          data-toggle="confirmation"
                                          data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                          data-btn-ok-class="btn btn-sm btn-danger"
                                          data-btn-cancel-label="Cancel"
                                          data-btn-cancel-icon="fa fa-chevron-circle-left"
                                          data-btn-cancel-class="btn btn-sm btn-default"
                                          data-title="Are you sure you want to delete ?"
                                          data-placement="left" data-singleton="true">
                                           Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Charts</h6>
        </div>
        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>

<script>

$(document).ready(function () {


$('#master').on('click', function(e) {
 if($(this).is(':checked',true))  
 {
    $(".sub_chk").prop('checked', true);  
 } else {  
    $(".sub_chk").prop('checked',false);  
 }  
});


$('.delete_all').on('click', function(e) {


    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
        allVals.push($(this).attr('data-id'));
    });  


    if(allVals.length <=0)  
    {  
        alert("Please select row.");  
    }  else {  


        var check = confirm("Are you sure you want to delete this row?");  
        if(check == true){  


            var join_selected_values = allVals.join(","); 
            console.log(join_selected_values);

            $.ajax({
                url: $(this).data('url'),
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'ids='+join_selected_values,

                success: function (data) {
                   
                    if (data['success']) {
                        $(".sub_chk:checked").each(function() {  
                            $(this).parents("tr").remove();
                        });
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


          $.each(allVals, function( index, value ) {
              $('table tr').filter("[data-row-id='" + value + "']").remove();
          });
        }  
    }  
});


$('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
        element.trigger('confirm');
    }
});


$(document).on('confirm', function (e) {
    var ele = e.target;
    e.preventDefault();


    $.ajax({
        url: ele.href,
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            if (data['success']) {
                $("#" + data['tr']).slideUp("slow");
                alert(data['success']);
            } else if (data['error']) {
                alert(data['error']);
            } else {
                alert('Whoops Something went wrong!!');
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });


    return false;
});
});

//CHARTS
Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik data pegawai'
    },
    subtitle: {
        text: 'Source: datadummy.com'
    },
    xAxis: {
        categories: {!! json_encode($categories) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'age (year old)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} yo</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'age',
        data: {!! json_encode($age) !!}
    }]
});

</script>
    @endsection