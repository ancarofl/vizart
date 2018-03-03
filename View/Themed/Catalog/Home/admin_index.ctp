 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Vizitatori</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>

<div class="row">

<?php
foreach($intrebari as $intrebareId => $intrebare) {


  if(count($intrebare['raspunsuri']) <= 2) {
    //we use bar charts ?>
<div class="col-md-6 card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> <?=$intrebare['intrebare']?></div>
            <div class="card-body">
              <canvas id="myBarChart<?=$intrebareId?>"></canvas>
            </div>
            <div class="card-footer small text-muted"></div>
          </div>
  <?php
} else { ?>

<div class="col-md-6 card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> <?=$intrebare['intrebare']?></div>
            <div class="card-body">
              <canvas id="myPieChart<?=$intrebareId?>"></canvas>
            </div>
            <div class="card-footer small text-muted"></div>
          </div>
<?php }
}
?>


</div>



 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
      <script type="text/javascript">
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['<?=implode("', '", array_flip($vizite))?>'],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: ['<?=implode("', '", $vizite)?>'],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?=max($vizite)?>,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
// -- Bar Chart Example


<?php
$colors = array('#007bff', '#dc3545', '#ffc107', '#28a745', '#FF5733', '#E9967A', '#ABEBC6', '#212F3D', '#6C3483', '#AF601A');


  foreach($intrebari as $intrebareId => $intrebare) {
    $text = array();
    $total = array();
    
        foreach($intrebare['raspunsuri'] as $raspuns) {
          $text[] = $raspuns['text'];
          $total[] = $raspuns['total'];
        }
      
if(count($intrebare['raspunsuri']) <= 2) { 
      ?>

      var ctx = document.getElementById("myBarChart<?=$intrebareId?>");
var myLineChart = new Chart(ctx, {

  type: 'bar',

  data: {
    labels: ['<?=implode("', '", $text)?>'],
    datasets: [{
      label: "<?=$intrebare['intrebare']?>",
      backgroundColor: ['<?=$colors[rand(0,count($colors)-1)]?>', '<?=$colors[rand(0,count($colors)-1)]?>'],
      borderColor: "rgba(2,117,216,1)",
      data: [<?=implode(", ", $total)?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?=(count($total)>0)?max($total):100?>,
          maxTicksLimit: 1
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

 <?   } else {  ?>
// -- Pie Chart Example
var ctx = document.getElementById("myPieChart<?=$intrebareId?>");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['<?=implode("', '", $text)?>'],
    datasets: [{
      data: [<?=implode(", ", $total)?>],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

  <?php }
  }

?>

      </script>