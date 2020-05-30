{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Thống kê doanh thu')

@section('content_header')
<h1>Thống kê doanh thu</h1>
@stop

@section('content')
<div class="">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{route('admin.order.group.post')}}" method="Post">
            <div class="form-group">
                <select id="order-group" class="form-control" name="groupYear" >
                    <option value="2019">2019</option>
                    <option value="2020" selected>2020</option>
                    <option value="2021">2021</option>
                </select>
            </div>
        </form>
        <div class="row">
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                </div>
              </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stop


@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/demo.js"></script>
<script>
     $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#barChart').get(0).getContext('2d')
    
    var currentData = {{json_encode($data)}};
     console.log(currentData);
     
    

    var areaChartData = {
      labels  : ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7','Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
      datasets: [
        {
          label               : 'Thu',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : currentData[1]
        },
        {
          label               : 'Chi',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0,0,0,0,0,0,0,0,0,0,0,0]
        },
      ]
    }

    

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    var url = "{{route('admin.order.group.post')}}";
    var orderGroup = document.querySelector('#order-group');

    orderGroup.addEventListener('change', function(){
    
    fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': csrfToken
          },
          body: JSON.stringify({groupYear:orderGroup.value })

        })
        .then(response => response.json())
        .then(data => {
          areaChartData.datasets[0].data = data.data[1];
          areaChartData.datasets[1].data = data.data[0];
          
          var barChart = new Chart(barChartCanvas, {
            type: 'bar', 
            data: barChartData,
            options: barChartOptions
        })
        
        })
        .catch((err) => {
          console.log(err);
        })
    
})
})




</script>
@stop
