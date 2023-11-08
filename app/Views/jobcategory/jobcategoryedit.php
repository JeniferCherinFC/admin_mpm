



<?=$this->include('components/topbar')?>
<?=$this->include('components/sidebar')?>
<div id="page-wrapper">
		  <div class="header">
                        <h1 class="page-header">
                        <small>  </small>
                        </h1>
					<ol class="breadcrumb">
					  <li><a href="/jobcategory">JobCategory </a></li>
					  <li><a href="/jobcategory">List</a></li>
					  <li class="active">Data</li>


					</ol>
                    
                    <?php
                    if(isset($Jcategory)) {
                        $categorydata = $Jcategory[0];
                        } 
                      ?>

                    <div id="page-inner"> 
              <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add Category
                        </div>
                        <div class="panel-body">

                                    <div class="row ">
                                     <div class="col-lg-12">

                                                        <?php
                                        $attributes = ['enctype'=>"multipart/form-data",'class' => 'form-horizontal', 'id' => 'categoryUpdate','method'=>'POST','autocomplete'=>'off'];
                                        echo form_open('jobcategory/upsert', $attributes);
                                       
                                        ?>
                                            <label>Category Name</label>
                                            <input class="form-control pb-4" name="categoryName" id="categoryName" placeholder="Enter Category" value="<?php if(isset($categorydata) && $categorydata['categoryName'] != '') echo $categorydata['categoryName']; ?>"></input>
                                            <label>Display order</label>
                                            <input class="form-control pb-4" name="categoryDorder" id="categoryDorder" placeholder="Enter Category" value="<?php if(isset($categorydata) && isset($categorydata['catdisplayOrder']) ) echo $categorydata['catdisplayOrder'];else echo ""; ?>"></input>
                                          
                                                    <label class="form-label" for="categoryImage">Image</label>
                                                     <input type="file"  name="categoryImage" id="categoryImage"  class="form-control"  />

                                       
                                           
                                         
                                        <button type="submit"  name="submit" value="Upload"  id="sbmtBtn"  class=" btn btn-default" style="margin: 17px;margin-left: 40%; ">Submit Button</button>

                                       
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                             
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
			</div>







                            </div>
                        </div>

                    </div>

                </div>

                </div>

                <script type="text/javascript">
          $(document).ready(function () {
	           $("#sbmtBtn").click(function(evt) {
		         if($('#categoryUpdate').valid()){
			  var categoryImage = $('#categoryImage').val();
			  var categoryName = $('#categoryName').val();
              var categoryDorder =$('#categoryDorder').val();

			$.ajax({
				type:'post',
				url: '<?= site_url('jobcategory/check-duplicate') ?>', 
				data:{'categoryName':categoryName,'categoryImage':categoryImage,'categoryDorder':categoryDorder},
				dataType: 'json',
				success:function(res){
					if(res.status == '1'){ 
						$('#sbmtBtn').attr("disabled", true);
						$('#categoryUpdate').submit();
					} else if(res.status == '0'){
						toastr['error'](res.response, 'Alert');
					}
					if(res.status == '00' && $('#session_out').val() != '00'){
						toastr['error'](res.response, 'Alert'); $('#session_out').val('00');
						setTimeout(function(){ location.reload(); }, 1500);
					}
				}
			});
		}
	});
});
</script>

<?=$this->include('components/footer')?>
