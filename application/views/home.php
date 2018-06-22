<?php
echo $header; ?>
     <!-- /.aside -->
      <section id="content">
        <section class="hbox stretch">
          <section>
            <section class="vbox">
              <section class="scrollable padder">
                <section class="row m-b-md">
                  <div class="col-sm-6">
				  
                    <h3 class="m-b-xs text-black">Dashboard</h3>
                    <small><?php echo $welcome_back; ?>, <?php echo $fullname; ?>, <i class="fa fa-users fa-lg text-primary"></i> <?php echo $level ?></small> </div>
	   
                  <div class="col-sm-6 text-right text-left-xs m-t-md">
				  
                    
                    <a href="#" class="btn btn-icon b-2x btn-default btn-rounded hover"><i class="i i-bars3 hover-rotate"></i></a> <a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a> </div>

                </section>
                <main class="main">
                    <div class="container-fluid">
                          <div class="animated fadeIn">
                            <div class="row">
                              <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-primary">
                                  <div class="card-body pb-0">
                                    
                                     <div class="text-value" style="font-size: 3rem;"><?php print_r($total_merchant[0]); ?></div>
                                    <div style="font-size: 2rem;">JUMLAH Merchant</div>
                                  </div>
                                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                  </div>
                                </div>
                              </div>
                              <!--/.col-->
                              <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-info">
                                  <div class="card-body pb-0">
                                    
                                    <div class="text-value" style="font-size: 3rem;"><?php print_r($total_cashier); ?></div>
                                     <div style="font-size: 2rem;">JUMLAH Kasir</div>
                                  </div>
                                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas id="card-chart2" class="chart" height="70"></canvas>
                                  </div>
                                </div>
                              </div>
                              <!--/.col-->
                              <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-warning">
                                  <div class="card-body pb-0">
                                    <div class="text-value" style="font-size: 3rem;">0</div>
                                    
                                    <div style="font-size: 2rem;">JUMLAH blaaa</div>
                                  </div>
                                  <div class="chart-wrapper mt-3" style="height:70px;">
                                    <canvas id="card-chart3" class="chart" height="70"></canvas>
                                  </div>
                                </div>
                              </div> 
                              <!--/.col-->
                              <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-danger">
                                  <div class="card-body pb-0">
                                    <div class="text-value" style="font-size: 3rem;">0</div>
                
                                    <div style="font-size: 2rem;">JUMLAH blaaa</div>
                                  </div>
                                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas id="card-chart4" class="chart" height="70"></canvas>
                                  </div>
                                </div>
                              </div>
                              <!--/.col-->
                            </div>
                            <!--/.row-->
                            </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="chart-container" style="position: relative; height:150vh; width:80vw">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>                
                    
                                <!--/.col-->
                            </div>
                            <!--/.row-->
                        </div>
                    
                    </div>
                </main>
<script src="<?php echo base_url() ?>assets/js/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels:<?php echo json_encode($total_merchant_chart);?>,
            datasets: [{
                    label: "Jumlah Merchant",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 1, 2, 3, 4, 5, 6, 7],
                }]
        },

        // Configuration options go here
        options: {}
    });
</script>
            </section>
          </section>

        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
    </section>
  </section>
</section>

<?php 
echo $footer;
?>