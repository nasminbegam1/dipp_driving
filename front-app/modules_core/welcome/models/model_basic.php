<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
        public function get_option($id) {

  	$sql = "SELECT sitesettings_name,sitesettings_value FROM dt_sitesettings WHERE sitesettings_id='".$id."'";

        $query = $this->db->query($sql);

            if ($query->num_rows() > 0){

                foreach ($query->result_array() as $row){

                    $rec['option_name'] = $row['option_value'];

                }

                return $rec;

            }

            return false;

 	}
        /********************17.7.2015**********************/
	function addDB($table, $insert_arr=array()) {
		$this->db->insert($table, $insert_arr);
		return $this->db->insert_id();
		/*echo $this->db->last_query();
		exit;*/
	}
	function existsDB($table, $condition_arr=array()) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition_arr);
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
	
	

	function detailsDB($table,$condition_arr=array(),$selectField='*',$order ='',$order_by ='',$startLimit='',$endLimit=''){
		$this->db->select($selectField);
		$this->db->from($table);
		$this->db->where($condition_arr);
		if($order != '')
		$this->db->order_by($order, $order_by);
		if($startLimit!='' && $endLimit!='')
		$this->db->limit($endLimit,$startLimit);
		$query=$this->db->get();
		//echo $this->db->last_query(); die();
		return $query->result_array();
	}
	function editDB($table, $update_arr=array(),$condition_arr=array()) {
		$this->db->where($condition_arr);
		$update= $this->db->update($table, $update_arr);
		//echo $this->db->last_query(); die();
		if($update) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	function deleteSellerDB($table, $condition_arr=array()) {
		$this->db->where($condition_arr);
		$this->db->delete($table);
		if($this->db->affected_rows() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	function detailsJoinDB($table,$table1,$joinCondition,$condition_arr=array(),$select = '*',$order='id',$order_by='desc'){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table1, $joinCondition);
		$this->db->where($condition_arr);
		$this->db->order_by($order, $order_by); 
		$query=$this->db->get();
		return $query->result_array();
	}
	function threeTableJoin($table,$table1,$table2,$joinCondition,$joinCondition1,$condition_arr=array(),$order='id',$order_by='desc'){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table1, $joinCondition);
		$this->db->join($table2, $joinCondition1);
		$this->db->where($condition_arr);
		$this->db->order_by($order, $order_by); 
		$query=$this->db->get();
		return $query->result_array();
	}
	function fourTableJoin($table,$table1,$table2,$table3,$joinCondition,$joinCondition1,$joinCondition2,$condition_arr=array(),$order='id',$order_by='desc'){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table1, $joinCondition);
		$this->db->join($table2, $joinCondition1);
		$this->db->join($table3, $joinCondition2);
		$this->db->where($condition_arr);
		$this->db->order_by($order, $order_by); 
		$query=$this->db->get();
		return $query->result_array();
	}
	public function insertIntoTable($tableName,$insertArr){
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if( $insertArr && is_array($insertArr) ){
			$this->db->insert($tableName, $insertArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->insert_id(); 
		}
		
		return $ret;
	}
	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM ".SITESETTINGS." WHERE sitesettings_id in (".$id.") ";
		
		$query = $this->db->query($sql);
		$rec = false;
		if ($query->num_rows() > 0){
		    foreach ($query->result_array() as $row){
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}
	function getCourseId($condition_arr){
		
		$this->db->select('INS.course_id,C.name,INS.instructor_logo,INS.instructor_business_name');
		$this->db->from(STUDENT.' ST');
		$this->db->join(INSTRUCTOR.' INS', 'ST.instructor_id = INS.instructor_id');
		$this->db->join(COURSE_MASTER.' C', 'INS.course_id = C.id');
		$this->db->where($condition_arr);
		$query=$this->db->get();
		return $query->row();
	}
	
	function get_option_value($id) {
		$this->db->select('sitesettings_name,sitesettings_value');
		$this->db->from(SITESETTINGS);
		$this->db->where(array('sitesettings_id'=>$id));
		$query = $this->db->get();
		$result = $query->row();
		return $result->sitesettings_value;
	}
	
	function siteSettingValue($id){
		$this->db->select('*');
		$this->db->from(SITESETTINGS);
		$this->db->where(array('status'=>'active'));
		$this->db->where_in('sitesettings_id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query(); die();
		return $result;
	}
        
        function detailsNewsDB($table,$condition_arr=array(),$selectField='*',$order ='',$order_by ='',$startLimit='',$endLimit=''){
		$this->db->select($selectField,FALSE);
		$this->db->from($table);
		$this->db->where($condition_arr);
		if($order != '')
		$this->db->order_by($order, $order_by);
		if($startLimit!='' && $endLimit!='')
		$this->db->limit($endLimit,$startLimit);
		$query=$this->db->get();
		//echo $this->db->last_query(); die();
		return $query->result_array();
	}
        
}