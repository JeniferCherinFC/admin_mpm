



<?=$this->include('components/topbar')?>
<?=$this->include('components/sidebar')?>
<div id="page-wrapper">
		  <div class="header">
                        <h1 class="page-header">
                        <?php echo $head; ?><small>  <?php echo $title; ?></small>
                        </h1>
					<ol class="breadcrumb">
					  <li><a href="/jobcategory"> <?php echo $head; ?></a></li>
					  <li><a href="/jobcategory">List</a></li>
					  <li class="active">Data</li>


					</ol>
                    <?php $categorydata = $userDetails[0];?>

                    <div id="page-inner">
                    <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <?php echo $categorydata['categoryName'];?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                            <table class="table ">
                        <tbody>
                            <tr>
                                <th scope="row">Category Image</th>
                                <td><img src="<?php echo $categorydata['categoryImage']; ?>" width="128" height="128" class="rounded-circle img-thumbnail" alt="<?php echo $categorydata['categoryName'];?> Image"></td>
                            </tr>
                           
                           
                            <tr>
                                <th scope="row">Id</th>
                                <td><?php echo $categorydata['id'];
                                                       
                                                        ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Name</th>
                                <td><?php 
                                                            echo $categorydata['categoryName'];
                                                       
                                                        ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Category Id</th>
                                <td><?php 
                                                            echo $categorydata['categoryId'];
                                                       
                                                        ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Category Display Order</th>
                                <td><?php 
                                                            echo $categorydata['catdisplayOrder'];
                                                       
                                                        ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Updated At</th>
                                <td><?php 
                                                            echo $categorydata['updatedAt'];
                                                       
                                                        ?></td>
                            </tr><tr>
                                <th scope="row">Created At</th>
                                <td><?php 
                                                            echo $categorydata['createdAt'];
                                                       
                                                        ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Updated by</th>
                                <td><?php 
                                                            echo $categorydata['updatedBy'];
                                                       
                                                        ?></td>
                            </tr><tr>
                                <th scope="row">Created by</th>
                                <td><?php 
                                                            echo $categorydata['createdBy'];
                                                       
                                                        ?></td>
                            </tr>

                        </tbody>
                    </table>



                            </div>
                        </div>
                    </div>







                                <!-- <div class="list-group">


                                    <a href="#" class="list-group-item">
                                        <span class="badge" >  <?php echo $categorydata['id']; ?></span>
                                        <i class="fa fa-fw fa-comment"></i> ID
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">16 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">36 minutes ago</span>
                                        <i class="fa fa-fw fa-globe"></i> Invoice 653 has paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1.23 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                </div> -->
                                <!-- <div class="text-right">
                                    <a href="#">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>

                    </div>

                </div>

                </div>



<?=$this->include('components/footer')?>
