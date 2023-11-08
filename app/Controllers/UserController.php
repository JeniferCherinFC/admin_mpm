<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(){

		$this->data['title'] = "list ";
		$this->data['head'] = "UserDetails";
		echo view('user/userlist', $this->data);
	}


	// public function __construct(){  
	// 	parent::__construct();  
	// 	if($this->checkSession('A')==''){
	// 		$this->setFlashMessage('error', lang('Common.alert_session_expired'));
	// 		$this->forceRedirect('login');
	// 	} 
	// 	$this->AccountModel = new \App\Models\AccountModel();
	// 	$this->TransactionsModel = new \App\Models\TransactionsModel();

	// }
	
	// public function index(){  
	// 	$this->data['title'] = 'Agents';
	// 	$this->data['ftype']=$this->request->getPostGet('ftype');
	// 	$this->data['fvalue']=$this->request->getPostGet('fvalue');
	// 	$this->data['dialcode']=$this->request->getPostGet('dialcode');
	// 	$this->data['sel_date']=$this->request->getPostGet('sel_date');
	// 	$this->data['status']=$this->request->getPostGet('status');
	// 	$this->data['stations']=$this->request->getPostGet('stations');
	// 	$this->data['gender']=$this->request->getPostGet('gender');
		
	// 	if($this->request->getPostGet('export') == 'excel'){
	// 		$ajaxDataArr = $this->list_ajax('array'); 
	// 		if($ajaxDataArr['status'] == '1'){
	// 			$agents = $ajaxDataArr['response'];
	// 			$spreadsheet = new Spreadsheet();
	// 			$sheet = $spreadsheet->getActiveSheet();
	// 			$sheet->setCellValue('A1', 'Agent Id');
	// 			$sheet->setCellValue('B1', 'Station Name');
	// 			$sheet->setCellValue('C1', 'Agent Name');
	// 			$sheet->setCellValue('D1', 'Email');
	// 			$sheet->setCellValue('E1', 'Gender');
	// 			$sheet->setCellValue('F1', 'Dial Code');
	// 			$sheet->setCellValue('G1', 'Phone Number');
	// 			$sheet->setCellValue('H1', 'Status');
	// 			$sheet->setCellValue('I1', 'Registered On');
	// 			$rows = 2;
	// 			foreach ($agents->result() as $ur){
	// 				$sheet->setCellValue('A' . $rows, $ur->agent_id);
	// 				$sheet->setCellValue('B' . $rows, $ur->station_name);
	// 				$sheet->setCellValue('C' . $rows, $ur->agent_name);
	// 				$sheet->setCellValue('D' . $rows, $ur->email);
	// 				$sheet->setCellValue('E' . $rows, $ur->gender);
	// 				$sheet->setCellValue('F' . $rows, $ur->dial_code);
	// 				$sheet->setCellValue('G' . $rows, $ur->phone_number);
	// 				$sheet->setCellValue('H' . $rows, $ur->status);
	// 				$sheet->setCellValue('I' . $rows, $ur->created->toDateTime()->format('d-m-Y'));
	// 				$rows++;
	// 			}
	// 			$writer = new Xlsx($spreadsheet);
	// 			$file_name = 'agents-'.time().'.xlsx';
	// 			$writer->save(WRITEPATH.'downloads'.DIRECTORY_SEPARATOR.$file_name);
	// 			return $this->response->download(WRITEPATH.'downloads'.DIRECTORY_SEPARATOR.$file_name, null)->setFileName($file_name);	
	// 		} else {
	// 			$this->setFlashMessage('error', $ajaxDataArr['response']);
	// 			return redirect()->route('agents/list');
	// 		}
	// 	}
	// 	$this->data['countryList'] = $this->AccountModel->get_all_details(COUNTRY, array('status' => 'Active'), array('name' => 1))->result();
	// 	$this->data['stationList'] = $this->AccountModel->get_all_details(STATIONS, array('status' => 'Active'))->result();
	// 	echo view('agents/list', $this->data);
	// }

	public function list_data($returnType='json') {
        // if ($this->checkSession('A') == '') {
		// 	$returnArr = array(
		// 		"status" => '00',
		// 		"response" => lang('Common.alert_session_timeout'),
		// 		"draw" => intval($this->request->getPostGet('draw')),
		// 		"iTotalRecords" => 0,
		// 		"iTotalDisplayRecords" => 0,
		// 		"aaData" => array()
		// 	);
        // } else {
			// $draw = $this->request->getPostGet('draw');
			// $ftype = $this->request->getPostGet('ftype');
			// $row_start = $this->request->getPostGet('start');
			// $rowperpage = $this->request->getPostGet('length'); // Rows display per page
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
			$totCounts = $this->UserModel->get_all_counts(JS_USERS, $condition);
			// $sortArr = array('created' => -1);
			// if($sortField != ''){
			// 	$sortArr = array($sortField => $sortJob);
			// }
			$userData = $this->UserModel->get_all_details(JS_USERS, $condition);
		

			// if(isset($_GET['export']) && $_GET['export'] == 'excel'){
			// 	$returnArr['status'] = '1';
			// 	$returnArr['response'] = $ajaxDataArr;
			// 	return $returnArr;
			// }	
			$tblData = array();
			// $position = 1;
			foreach($userData as $row){
				$rowId =  (string)$row['id'];
				$jsId =  (string)$row['jsId'];
				$name =  (string)$row['name'];
				$mobile =  (string)$row['mobile'];
				$isMobileVerified =  (string)$row['isMobileVerified'] == "1" ? "Valid":"Unvalid";
				$email =  (string)$row['email'];
				$userRole =  (string)$row['userRole'];
				$userStatus =  (string)$row['userStatus'] == "1" ? "Active":"Inactive";
				$lastLogoutdate =  (string)$row['lastLogoutdate'];
				$token =  (string)$row['token'];


		



				// $disp_status = 'Inactive';
				// $actTitle = lang('Common.btn_click_active');  $mode = 1;  $btnColr = 'btn-dark';
				// if(isset($row->status) && $row->status == 'Active'){
				// 	$disp_status = 'Active';
				// 	$mode = 0; $btnColr = 'btn-success'; $actTitle = lang('Common.btn_click_inactive');
				// }
				//  $statusTxt = $actTitle;
				 $actionTxt = '';
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
				$actionTxt = '<a class="action-a btn btn-icon waves-effect waves-light m-b-5" href=""><i class="fa fa-search-minus"></i></a>';
				$actionTxt .= '<a class="action-a btn btn-icon waves-effect waves-light  m-b-5" href=""><i class="fa fa-edit"></i></a>';
				$actionTxt.='<a href="" class="action-a delconfirm btn btn-icon waves-effect waves-light  m-b-5" data-row_id="" data-act_url=""> <i class="fa fa-trash-o"></i></a>';

				$tblData[] = array( 
					'DT_RowId' => (string)$rowId,
					'checker_box' => '<input class="checkRows" name="checkbox_id[]" type="checkbox" value="'.$rowId.'">',
					'jsId'=> $jsId,
					'name'=> $name,
					'mobile'=> $mobile,
					'isMobileVerified'=> $isMobileVerified,
					'email'=> $email,
					'userRole'=> $userRole,
					'userStatus'=> $userStatus,
					'lastLogoutdate'=> $lastLogoutdate,
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
	
}
