
<?=$this->include('components/topbar')?>
<?=$this->include('components/sidebar')?>
    <!-- /. NAV SIDE  -->
 
        <div id="page-wrapper">
		  <div class="header">
                        <h1 class="page-header">
                        <?php echo $head; ?><small></small>
                        </h1>
					<ol class="breadcrumb">
					  <li><a href="#"><?php echo $head; ?></a></li>
					  <li><a href="#"> <?php echo $title; ?></a></li>
					  <li class="active">Data</li>
					</ol>

              
    <!-- Insert your custom loading animation here -->
<!-- </div> -->

                    <div id="page-inner"> 
                    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                            <table class="table table-striped table-bordered  table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input name="checkbox_id[]" type="checkbox" value="on" class="checkall"></th>
                                        <th>JsId</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>MblVerify</th>
                                        <th>UserRole</th>
                                        <th>Status</th>
                                        <th>LogoutDate</th>
                                        <th>Action</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
</div>



<script type="text/javascript">
   $(document).ready(function(){
      $('#dataTables-example').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'get',
         'ajax': {
            'url':'<?= site_url('user_data') ?>',
            'data': function(data){
               return {
                  data: data,
                //   [csrfName]: csrfHash // CSRF Token
               };
            },
        
         },
         'columns': [
            {data:'checker_box'},
            {data:'jsId'},
            {data:'name'},
            {data:'email'},
            {data:'mobile'},
            {data:'isMobileVerified'},
            {data:'userRole'},
            {data:'userStatus'},
            {data:'lastLogoutdate'},
            {data:'action'},

         ]
      });
   });

   </script>

   
<?=$this->include('components/footer')?>