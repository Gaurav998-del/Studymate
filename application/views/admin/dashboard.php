<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="//www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/datatables.net/css/dataTables.bootstrap.min.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">
<style>
#chartdiv {
  width: 100%;
  height: 350px;
}							
</style>
<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua" style="background-color: #842450 !important"><i class="ion ion-help-circled"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Questions</span>
              <span class="info-box-number"><?php echo $totalQuestions;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-help-buoy"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Questions today</span>
              <span class="info-box-number"><?php echo $totalQuestionsToday;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-lightbulb"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Answers</span>
              <span class="info-box-number"><?php echo $totalAnswers;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-person-stalker"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?php echo $totalUsers;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
				<h3 class="box-title">Monthly Recap Report</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="chartdiv"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
			<!-- MAP & BOX PANE -->
			<!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Recently added questions</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
					<thead>
					<tr>
						<th>#</th>
						<th>Question Name</th>
						<th>Status</th>
						<th>Posted on</th>
					</tr>
					</thead>
					<tbody>
						<?php if (count($recentlyPostedQuestions)>0) {
						foreach ($recentlyPostedQuestions as $index=>$value) {?>
						<tr>
							<td><?php echo $index+1?></td>
							<td>
								<a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>"><?php echo $value['title'];?></a>
							</td>
							<td>
								<span class="label label-<?php echo $value['status']==1?"success":"danger";?>"><?php echo $value['status']==1?"Approved":"Not approved";?></span>
							</td>
							<td>
								<?php echo date('d M, Y',strtotime($value['on']));?>
							</td>
						</tr>
						<?php }
						} else {?>
						<td colspan='4' class="text-center">No record found</td>
						<?php } ?>
					</tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
				<a href="<?php echo base_url()."admin/questions"?>" class="btn btn-sm btn-default btn-flat pull-right">View All Questions</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/includes/footer');?>
<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
<script src="//www.amcharts.com/lib/3/serial.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 40,
  "marginLeft": 40,
  "autoMarginOffset": 20,
  "dataDateFormat": "YYYY-MM-DD",
  "valueAxes": [ {
    "id": "v1",
    "axisAlpha": 0,
    "position": "left",
    "ignoreAxisWidth": true
  } ],
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  "graphs": [ {
    "id": "g1",
    "balloon": {
      "drop": true,
      "adjustBorderColor": false,
      "color": "#ffffff",
      "type": "smoothedLine"
    },
    "fillAlphas": 0.2,
    "bullet": "round",
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "title": "red line",
    "useLineColorForBulletBorder": true,
    "valueField": "value",
    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
  } ],
  "chartCursor": {
    "valueLineEnabled": true,
    "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "zoomable": false,
    "valueZoomable": true,
    "valueLineAlpha": 0.5
  },
  "valueScrollbar": {
    "autoGridCount": true,
    "color": "#000000",
    "scrollbarHeight": 50
  },
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": true,
    "dashLength": 1,
    "minorGridEnabled": true
  },
  "export": {
    "enabled": true
  },
  "dataProvider": [
	  <?php foreach ($questionsRecord as $index=>$value) {?>
	{
        "date": "<?php echo date('Y-m-d',strtotime($value['on']));?>",
        "value": <?php echo $value['totalQuestions'];?>
    }<?php echo ($index+1)!=$tquestionsRecord?",":"";?>
	
 <?php } ?>]
} );
</script>
<script>
$(document).ready(function() {
	var chart = AmCharts.makeChart( "charstdiv", {
	  "type": "serial",
	  "theme": "light",
	  "marginRight": 40,
	  "marginLeft": 40,
	  "autoMarginOffset": 20,
	  "dataDateFormat": "YYYY-MM-DD",
	  "valueAxes": [ {
		"id": "v1",
		"axisAlpha": 0,
		"position": "left",
		"ignoreAxisWidth": true
	  } ],
	  "balloon": {
		"borderThickness": 1,
		"shadowAlpha": 0
	  },
	  "graphs": [ {
		"id": "g1",
		"balloon": {
		  "drop": true,
		  "adjustBorderColor": false,
		  "color": "#ffffff",
		  "type": "smoothedLine"
		},
		"fillAlphas": 0.2,
		"bullet": "round",
		"bulletBorderAlpha": 1,
		"bulletColor": "#FFFFFF",
		"bulletSize": 5,
		"hideBulletsCount": 50,
		"lineThickness": 2,
		"title": "red line",
		"useLineColorForBulletBorder": true,
		"valueField": "value",
		"balloonText": "<span style='font-size:18px;'>[[value]]</span>"
	  } ],
	  "chartCursor": {
		"valueLineEnabled": true,
		"valueLineBalloonEnabled": true,
		"cursorAlpha": 0,
		"zoomable": false,
		"valueZoomable": true,
		"valueLineAlpha": 0.5
	  },
	  "valueScrollbar": {
		"autoGridCount": true,
		"color": "#000000",
		"scrollbarHeight": 50
	  },
	  "categoryField": "date",
	  "categoryAxis": {
		"parseDates": true,
		"dashLength": 1,
		"minorGridEnabled": true
	  },
	  "export": {
		"enabled": true
	  },
	  "dataProvider": [
	  <?php foreach ($questionsRecord as $index=>$value) {?>
	{
        "date": "<?php echo date('Y-m-d',strtotime($value['on']));?>",
        "value": <?php echo $value['totalQuestions'];?>
    }<?php echo ($index+1)!=$tquestionsRecord?",":"";?>
 <?php } ?>]
	} );
});
</script>
