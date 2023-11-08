
<?=$this->include('components/topbar')?>
<?=$this->include('components/sidebar')?>
    <!-- /. NAV SIDE  -->
 
        <div id="page-wrapper">
		  <div class="header">
                        <h1 class="page-header">
                        <?php echo $head; ?><small>  <?php echo $title; ?></small>
                        </h1>
					<ol class="breadcrumb">
					  <li><a href="#"> <?php echo $head; ?></a></li>
					  <li><a href="#">List</a></li>
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
                                        <th>CategoryId</th>
                                        <th>Name</th>
                                        <th>updatedAt</th>
                                        <th>updatedBy</th>
                                        <th>createdAt</th>
                                        <th>createdBy</th>
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
            'url':'<?= site_url('jobcategory_data') ?>',
            'data': function(data){
                console.log(data);
               return {
                  data: data,
                //   [csrfName]: csrfHash // CSRF Token
               };
            },
        
         },
        

         'columns': [
            {data:'checker_box'},
            {data:'categoryId'},
            {data:'categoryName'},
            {data:'updatedAt'},
            {data:'updatedBy'},
            {data:'createdAt'},
            {data:'createdBy'},
            {data:'action'},

         ]
      });
   });




   function comments_add(driver_id, vehicle_id) {
   
   
    page_type = route_name;
            $.ajax({
				type:'post',
				url: base_url+"/callcenter/call_center_history",
				data:{'driver_id':driver_id},
				dataType: 'json',

				success:function(res){
                    var history = '';
                    if (res.data){
                          $.each(res.data, function (key, entry) {
                            history += '<tr><td>'+entry.commented_on+'</td><td>'+entry.reason+'<br />['+entry.type+']</td><td>'+entry.comments+'</td><td>'+entry.commented_by+'</td></tr>';
                           });
                        }
                
                       Swal.fire({
                            width: 800,
                            showCloseButton: true,
                            focusConfirm: false,
                            title: 'Comments & History',
                            html: comments_table+history_table,
                            confirmButtonText: 'Submit',
                            preConfirm: () => {
                                const reason = Swal.getPopup().querySelector('#reason').value
                                const comments = Swal.getPopup().querySelector('#comments').value
                                if (!reason || !comments) {
                                    Swal.showValidationMessage('Please enter the details')
                                }
                                return {
                                    reason: reason,
                                    comments: comments
                                }
                            }
                            }).then((result) => {
                            var url = '/callcenter/comments/add';
                            if (driver_id != '') {
                                var reason = result.value.reason;
                                var comments = result.value.comments
                                var input_data = {
                                    driver_id: driver_id,
                                    reason: reason,
                                    comments: comments,
                                    type: page_type,
                                    vehicle_id: vehicle_id
                                };
                                $.ajax({
                                    url: url,
                                    data: input_data,
                                    type: 'post'
                                }).done(
                                    function(result) {
                                        code = result;
                                        if (code != '') {
                                            Swal.fire(
                                                'Comment added!',
                                                'Successfully added comment',
                                                'success'
                                            );
                                            location.reload();
                                            return false;
                                        }
                                    });
                                 return false;
                            }
                        })

    
				
				}
  			});
        }
































function delconfirm (categoryId) {

                    Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete!'
                    }).then((result) => {
                        console.log(result);
                    if (result.value==true) {
                        var url = 'http://localhost:8080/jobcategory/delete';
                        if(categoryId!='') {
                            var input_data = {'categoryId':categoryId};
                            console.log(categoryId);
                            $.ajax({
                                url:url,
                                data:input_data,
                                type:'post'
                                }).done(function(result,value){
                                code = result;
                                console.log(code.response);
                                console.log(value);

                                if (code!='') {
                                    Swal.fire(
                                    'Selected category is deleted successfully.',
                                    'success'
                                    );
                                    location.reload();
                                    return false;
                                }
                            });
                            return false;
                        }
                    }
                    else {
                    Swal.fire('Fine. Did not delete.');
                    }
                    });

                }



















   </script>












// function delconfirm(categoryId) {
//     var row_id = categoryId;
// 		var act_url = "/jobcategory/delete";
// 		var base_url ="http://localhost:8080/jobcategory/delete";
//   Swal.fire({
// 	    title: "Are you sure?",
// 			text: "You won't be able to revert this!",
// 			type: "warning",
// 			// confirmButtonClass: "btn btn-success mt-2",
// 			// cancelButtonClass: "btn btn-danger ml-2 mt-2",
//     showCloseButton: true,
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: "Yes, Delete!", 
// 			cancelButtonText: "No, Cancel!",
//    }).then(function(t,evt) {
//   if (t.value == true) {
// 		$.ajax({
// 					type:'post',
// 					url:base_url+act_url,
// 					data:{'delete_id':row_id},
// 					// dataType: 'json',
// 				}).done(function(res){
//             console.log(res);
						
// 						if(res.status == '1'){ 
// 							Swal.fire({
// 								title: "Deleted!",
// 								text: res.response,
// 								type: "success"
// 							});
						
// 							setTimeout(function () { $('.swal2-confirm').trigger('click'); }, 2500);
// 						} else {
// 							Swal.fire({
// 								title: "Error",
// 								text: res.response,
// 								type: "error"
// 							});
// 						}
// 						if(res.status == '00'){
// 							setTimeout(function(){ location.reload(); }, 1500);
// 						}
// 					});
    
//   }else {
//         Swal.fire('Fine. Did not send to repossess.');
//     }
// })

// }




<?=$this->include('components/footer')?>