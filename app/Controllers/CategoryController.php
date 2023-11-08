<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\CategoryModel;
use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
class CategoryController extends BaseController
{
   
	public function __construct(){  
		parent::__construct();

		// if($this->checkSession('A')==''){
		// 	$this->setFlashMessage('error', lang('Common.alert_session_expired'));
		// 	$this->forceRedirect('login');
		// } 
		// $this->AccountModel = new \App\Models\AccountModel();
		// $this->TransactionsModel = new \App\Models\TransactionsModel();

	}



    public function index(){
		$this->data['title'] = "list ";
		$this->data['head'] = "JobCategory";
		echo view('jobcategory/jobcategorylist', $this->data);
	}

	public function list_data($returnType='json') {
        // if ($this->checkSession('A') == '') {
		// 	$returnArr = array(
		// 		"status" => '00',
		// 		"response" => lang('Common.alert_session_timeout'),
				// "draw" => intval($this->request->getPostGet('draw'));
		// 		"iTotalRecords" => 0,
		// 		"iTotalDisplayRecords" => 0,
		// 		"aaData" => array()
		// 	);
        // } else {
			// $ftype = $this->request->getPostGet('ftype');
			$draw = $this->request->getPostGet('draw');
			$row_start = $this->request->getPostGet('start');
			$rowperpage = $this->request->getPostGet('length'); // Rows display per page
			// $columnIndex = 0;
			// if(isset($this->request->getPostGet('order')[0]['column'])){
			// 	$columnIndex = $this->request->getPostGet('order')[0]['column']; // Column index
			// }
			// $sortField = ''; // Column name
			// if(isset($this->request->getPostGet('columns')[$columnIndex]['data'])){
			// 	$sortField = $this->request->getPostGet('columns')[$columnIndex]['data'];
			// }
			// $columnIndex = 'asc';
			// if(isset($this->request->getPostGet('order')[0]['dir'])){
			// 	$sortJob = $this->request->getPostGet('order')[0]['dir']; // asc or desc
			// }
			// $dtSearchKeyVal = '';
			// if(isset($this->request->getPostGet('search')['value'])){
			// 	$dtSearchKeyVal = $this->request->getPostGet('search')['value']; // Search value
			// }
			// $condition = array();
			// if($dtSearchKeyVal != ''){
			// 	$condition['$or'] = array(
			// 		array('station_name' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i')),
			// 		array('agent_name' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i')),
			// 		array('unique_code' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i')),
			// 		array('email' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i')),
			// 		array('phone_number' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i')),
			// 		array('created' => array('$eq' => MongoDATE(strtotime($dtSearchKeyVal)))),
			// 		array('status' => array('$regex' => (string)trim($dtSearchKeyVal),'$options'=> 'i'))
			// 	);
			// }
			// if($ftype == 'manual'){
			// 	$fvalue=$this->request->getPostGet('fvalue');
			// 	if($fvalue!=''){
			// 		$condition['$or'] = array(
			// 			array('station_name' => array('$regex' => (string)trim($fvalue),'$options'=> 'i')),
			// 			array('agent_name' => array('$regex' => (string)trim($fvalue),'$options'=> 'i')),
			// 			array('phone_number' => array('$regex' => (string)trim($fvalue),'$options'=> 'i')),
			// 			array('email' => array('$regex' => (string)trim($fvalue),'$options'=> 'i')),
			// 			array('status' => array('$regex' => (string)trim($fvalue),'$options'=> 'i'))
			// 		);
			// 	}
			// 	if($this->request->getPostGet('status')!=''){
			// 		$status=$this->request->getPostGet('status');
			// 		$condition['status'] =$status;
			// 	}	
			// 	if($this->request->getPostGet('stations')!=''){
			// 		$stations=$this->request->getPostGet('stations');
			// 		$condition['station_id'] =$stations;
			// 	}	
			
			// 	if($this->request->getPostGet('sel_date') != ''){
			// 		$dRangeArr = @explode(' - ',$this->request->getPostGet('sel_date'));
			// 		$condition['created'] = array('$gte' => MongoDATE(strtotime($dRangeArr[0].' 00:00:00')),'$lte' => MongoDATE(strtotime($dRangeArr[1].' 23:59:59')));
			// 	} 	
			// }
			
            $condition=array();
			$totCounts = $this->CategoryModel->get_all_counts(JOB_CATEGORY, $condition);
			// $sortArr = array('created' => -1);
			// if($sortField != ''){
			// 	$sortArr = array($sortField => $sortJob);
			// }

			// if(isset($_GET['export']) && $_GET['export'] == 'excel'){
			// 	$returnArr['status'] = '1';
			// 	$returnArr['response'] = $ajaxDataArr;
			// 	return $returnArr;
			// }
			$categoryData = $this->CategoryModel->get_all_details(JOB_CATEGORY, $condition);
			$tblData = array();
			// $position = 1;'id',
      
			$rowId =$categoryName =	$categoryId=$updatedAt =$updatedBy =$createdAt =$createdBy ="";

			foreach($categoryData as $row){
				$rowId= $row['id'];
				$categoryName = $row['categoryName'];
				$categoryId =  $row['categoryId'];
				$updatedAt = $row['updatedAt'];
				$updatedBy =  $row['updatedBy'];
				$createdAt = $row['createdAt'];
				$createdBy =  $row['createdBy'];
				$actionTxt = '';
			



				// $disp_status = 'Inactive';
				// $actTitle = lang('Common.btn_click_active');  $mode = 1;  $btnColr = 'btn-dark';
				// if(isset($row->status) && $row->status == 'Active'){
				// 	$disp_status = 'Active';
				// 	$mode = 0; $btnColr = 'btn-success'; $actTitle = lang('Common.btn_click_inactive');
				// }
				//  $statusTxt = $actTitle;
				// if(checkPrivileges('agents.edit')){
				// $statusTxt =  '<a data-toggle="tooltip" data-original-title="'.$actTitle.'" class="stsconfirm" href="javascript:void(0);" data-row_id="'.$rowId.'" data-act_url="/agents/change-status" data-stsmode="'.$mode.'"> <button type="button" class="btn '.$btnColr.' btn-sm waves-effect waves-light">'.$disp_status.'</button></a>';
				// }
				// if(checkPrivileges('agents.view')){
				// $actionTxt = '<a class="action-a btn btn-icon waves-effect waves-light btn-secondary m-b-5" href="/agents/view/'.(string)$rowId.'"><i class="far fa-eye"></i></a>';
				// }
				// if(checkPrivileges('agents.edit')){
				// $actionTxt .= '<a class="action-a btn btn-icon waves-effect waves-light btn-primary m-b-5" href="/agents/edit/'.(string)$rowId.'"><i class="far fa-edit"></i></a>';
                // $actionTxt.='<a class="action-a btn btn-icon waves-effect waves-light btn-primary m-b-5" href="/agents/change_password_form/'.(string)$rowId.'"><i class="fa fa-key"></i></a>';

				// }
				// if(checkPrivileges('agents.delete')){
				// $actionTxt.='<a href="javascript:void(0);" class="action-a delconfirm btn btn-icon waves-effect waves-light btn-danger m-b-5" data-row_id="'.$rowId.'" data-act_url="/agents/delete"><i class="far fa-trash-alt"></i></a>';
				// }
				// $balanceInfo='0';
				// if(isset($row->wallet) && !empty($row->wallet) && isset($row->wallet['balance'])){
				// 	$balanceInfo = $row->wallet['balance'].' '.$row->currency_code;
				// }
				// $statusTxt =  '<a data-toggle="tooltip" data-original-title="'.$actTitle.'" class="stsconfirm" href="javascript:void(0);" data-row_id="'.$rowId.'" data-act_url="/agents/change-status" data-stsmode="'.$mode.'"> <button type="button" class="btn '.$btnColr.' btn-sm waves-effect waves-light">'.$disp_status.'</button></a>';
				
				
				



				$actionTxt = '<a class="action-a btn btn-icon waves-effect waves-light m-b-5" href="/jobcategory/view/'.(string)$categoryId.'"><i class="fa fa-search-minus"></i></a>';
				$actionTxt .= '<a class="action-a btn btn-icon waves-effect waves-light  m-b-5" href="/jobcategory/edit/'.(string)$categoryId.'"><i class="fa fa-edit"></i></a>';
				// $actionTxt.='<a href="" class="action-a delconfirm btn btn-icon waves-effect waves-light  m-b-5" data-row_id="" data-act_url=""> <i class="fa fa-trash-o"></i></a>';
				
				$actionTxt.='<a class="action-a  btn btn-icon waves-effect waves-light  m-b-5" onclick="delconfirm(\'' . $categoryId . '\')"  data-row_id="'.$categoryId.'" ><i class="fa fa-trash-o"></a>';

			
				$tblData[] = array( 
					'DT_RowId' => (string)$rowId,
					'checker_box' => '<input class="checkRows" name="checkbox_id[]" type="checkbox" value="'.$rowId.'">',
					'categoryId'=> $categoryId,
					'categoryName'=> $categoryName,
					'updatedAt'=> $updatedAt,
					'updatedBy'=> $updatedBy,
					'createdAt'=> $createdAt,
					'createdBy'=> $createdBy,
					// "status"=>  $statusTxt,
					"action"=>  $actionTxt
				   );			
			}



			## Response
			$response = array(
				// "status" => '1',
				// "draw" => intval($draw),
				"iTotalRecords" => $totCounts,
				"iTotalDisplayRecords" => $totCounts,
				"aaData" => $tblData
			);
			$returnArr = $response;
        // }
	

		echo json_encode($returnArr);
    }

	public function view($categoryId =""){
		$categoryId =$this->uri->getSegment(3);
		if($categoryId!=''){
			$condition = array('categoryId' =>$categoryId);
			$this->data['userDetails'] = $this->CategoryModel->get_all_details(JOB_CATEGORY,$condition);
			if(!empty($this->data['userDetails'])){
				$this->data['title'] = "JobCategory";
		        $this->data['head'] = "JobCategory";
				echo view('jobcategory/jobcategoryview', $this->data);
			}else{
				$this->setFlashMessage('error', "Couldnot find this user");
				return redirect()->route('jobcategory/jobcategorylist');
			}
		}else{
			$this->setFlashMessage('error', "Couldnot find this user");
			return redirect()->route('jobcategory/jobcategorylist');
		}
	}

	public function add_edit($id=""){ 
		$categoryId =$this->uri->getSegment(3);
		if($categoryId!=''){
			$condition = array('categoryId' =>$categoryId);
			$this->data['Jcategory'] = $this->CategoryModel->get_all_details(JOB_CATEGORY,$condition);
			if(!empty($this->data['Jcategory'])){
				$this->data['title'] = "JobCategory";
			}else{
				$this->setFlashMessage('error',"Could find this category");
				return redirect()->route('jobcategory');
			}
		}else{
			$this->data['title'] = "Add Category";
		}

		echo view('jobcategory/jobcategoryedit', $this->data);
	}

	public function insertUpdate(){
		$categoryId = (string)$this->request->getPostGet('categoryId');
		$categoryName = (string)$this->request->getPostGet('categoryName');
		$categoryDorder=$this->request->getPostGet('categoryDorder');
		$categoryImage = $this->request->getFile('categoryImage');
		$fSubmit = FALSE;
		if($categoryName != '' && $categoryImage !=""){
			// $duplicateChk = $this->check_category_duplicate('array');
			// if($duplicateChk['status'] == '0'){
			// 	$this->session->setFlashdata('error',  $duplicateChk['response']);
			// 	// $this->setFlashMessage('error', $duplicateChk['response']);
			// 	echo "<script>window.history.go(-1);</script>"; exit;
			// }
			$validated = $this->validate([
				'categoryImage' => [
					'uploaded[categoryImage]',
					'mime_in[categoryImage,image/jpg,image/jpeg,image/gif,image/png]',
					// 'max_size[categoryImage,]',
				],
			]);
			if ($validated) {
			  $filename= $_FILES["categoryImage"]["name"];
			  if($categoryId == ''){
				$categoryIdR = $this->UUID4();
				$id=$categoryIdR.$filename;
			   }else{
				$categoryIdR = $categoryId;
			   }
			  $id=$categoryIdR.$filename;
			  $folder="category_documents";
			  $aws= new \App\Libraries\S3Service;
			  $imageData=$aws->commonfileupload($folder,$categoryImage,$id);
			}else{
				$this->setFlashMessage('error', "Please select a valid file");
			}
			$slugName=strtolower($categoryName);
			$categorySlug=str_replace(" ","",$slugName);

			$dataArr = [
				'categoryName' =>$categoryName,
				'categoryImage'=>$imageData['data'],
				'createdAt'=> date('Y-m-d H:i:s'),
				'catSlug'=>$categorySlug
			];
			if($categoryId == ''){
				$dataArr['categoryId'] = $categoryIdR ;
				$this->CategoryModel->insert_data($dataArr);
				$fSubmit = TRUE;
			} else {
				$condition = array('categoryId' =>$categoryId);
				$dataArrr['updatedAt'] = date('Y-m-d H:i:s');
				$this->CategoryModel->update_data(JOB_CATEGORY,$dataArr,$condition);
				$fSubmit = TRUE;
			}




			
		} else {
			$this->setFlashMessage('error', "Data Missing");
		}
		if($fSubmit){
			$url = 'jobcategory/view/'.$categoryIdR;
		
		} else {
			if($categoryId == '') $url = 'jobcategory/add'; else $url = 'jobcategory/edit/'.$categoryId;
		}
		return redirect()->to("$url");
	}

	public function check_category_duplicate($returnType='json') {
			$categoryId = (string)$this->request->getPostGet('categoryId');
			$categoryName= (string)$this->request->getPostGet('categoryName');

			if($categoryName != '' && $categoryId != '' ){

				if ($categoryId != '') {
					// $condition=['categoryId'=>$categoryId] ;
					$condition = array('categoryName' =>array('$regex' =>trim($categoryName),'$options'=> 'i'));
					$dupChk = $this->CategoryModel->get_all_details(JOB_CATEGORY, $condition);
					if (sizeof($dupChk) >= 1) {
						    $returnArr['status'] = '0';
							$returnArr['response'] = "Category Name already exists";
					}else {
						$returnArr['status'] = '1';
						$returnArr['response'] = "Successfully added";
					}
			    }else{
							$returnArr['response'] = 'Id missing';
						
			        }
			} else {
				$returnArr['response'] = "Some fields missing";
			}
     
		if($returnType == 'json'){
			echo json_encode($returnArr); exit;
		} else {
			return $returnArr;
		}
    }

	public function delconfirm($id="") {
		
			$categoryId = $this->request->getPostGet('categoryId'); 
			if($categoryId > 0){
				$condition = array('categoryId' => $categoryId);
				$this->CategoryModel->common_delete(JOB_CATEGORY, $condition);
				$returnArr['status'] = '1';
				$returnArr['response'] = "Record deleted successfully";
			}else{
				$returnArr['status'] = '00';
				$returnArr['response'] = "Empty";

			}
        // }
		echo json_encode($returnArr); exit;
    }


}















