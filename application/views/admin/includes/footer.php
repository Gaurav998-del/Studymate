    <footer class="main-footer">
	<strong>Copyright &copy; 2020 <a href="">Study Mate</a>.</strong> All rights reserved.
	</footer>
<script src="<?php echo base_url()."admincss/bower_components/jquery/dist/jquery.min.js"?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."admincss/bower_components/bootstrap/dist/js/bootstrap.min.js"?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url()."admincss/bower_components/select2/dist/js/select2.full.min.js"?>"></script>

<script src="<?php echo base_url()."admincss/bower_components/moment/min/moment.min.js"?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()."admincss/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url()."admincss/plugins/iCheck/icheck.min.js"?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."admincss/bower_components/fastclick/lib/fastclick.js"?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."admincss/dist/js/adminlte.min.js"?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."admincss/dist/js/demo.js"?>"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>

