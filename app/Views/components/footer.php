</div>
      
				 <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
			
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="/assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <!-- Metis Menu Js -->
    <script src="/assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="/assets/js/custom-scripts.js"></script>
    
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<!-- Include SweetAlert from a CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script src="/assets/js/dataTables/jquery.dataTables.js"></script>
  <script src="/assets/js/dataTables/dataTables.bootstrap.js"></script>


<script>



// function delconfirm(categoryId) {
//     var row_id = categoryId;
// 		var act_url = "/jobcategory/delete";
// 		var base_url ="http://localhost:8080";
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
// 						$('.btn-success').removeAttr("disabled");
// 						if(res.status == '1'){ 
// 							Swal.fire({
// 								title: "Deleted!",
// 								text: res.response,
// 								type: "success"
// 							});
// 							$('#'+row_id).remove();
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













// Swal.fire({
//     title: 'Are you sure?',
//     text: "Repossession!",
//     showCloseButton: true,
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, send to repossess!'

// }).then((result) => {
//     if (result.value == true) {
//         var url = '/oneview/vehicles/update_status';
//         if (vehicle_id != '') {
//             var input_data = {
//                 vehicle_id: vehicle_id,
//                 vehicle_status:status,
//                 source:'CALLCENTER'
//             };
//             console.log(input_data);
//             $.ajax({
//                 url: url,
//                 data: input_data,
//                 type: 'post'
//             }).done(
//                 function(result) {
//                     code = result;
//                     if (code != '') {
//                         Swal.fire(

//                             'Repossess Notice is sent!',
//                             'Selected vehicle is sent to repossessed.',
//                             'success'
//                         );
//                         //location.reload();
//                         return false;
//                     }
//                 });
//             return false;
//         }
//     } else {
//         Swal.fire('Fine. Did not send to repossess.', '', 'info');
//     }
// });




















  // $(document).ready(function() {
 

  //   $(document).on("click",".delconfirm",function(evt) {
	// 	var row_id = $(this).attr('data-row_id');
	// 	var act_url = $(this).attr('data-act_url');
	// 	var base_url ="http://localhost:8080";


 

	//   });
  // });
</script>
   


</body>
</html>
