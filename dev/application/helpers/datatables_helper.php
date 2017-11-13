<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 

if (! function_exists('datatables_json'))
{
	function datatables_json($pagingresult,$cols){
		$ret = array();
		$ret['sEcho'] = isset($_GET['sEcho']) ? $_GET['sEcho'] : '';
		$ret['iTotalRecords'] = $pagingresult->totalrecords;
		$ret['iTotalDisplayRecords'] = $pagingresult->totalrecords;
		$data = array();
		if($pagingresult->data!=NULL){
			foreach($pagingresult->data as $v){
				$item = array();
				foreach($cols as $c){
				    if(is_object($v)){
                        if(!isset($v->$c)){
                            echo 'Not found '.$c;
                        }else{
                            $item[$c] = $v->$c;
                        }
                    }else if(is_array($v)){
                        if(!isset($v[$c])){
                            echo 'Not found '.$c;
                        }else{
                            $item[$c] = $v[$c];
                        }
                    }


				}
				$data[] = $item;
			}
		}
		$ret['aaData'] = $data;
		echo json_encode($ret);
	}
}
