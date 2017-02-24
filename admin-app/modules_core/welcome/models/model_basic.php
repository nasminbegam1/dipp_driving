<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	public function getValue_condition($TableName, $FieldName, $AliasFieldName, $Condition=''){
		if($Condition=="")
                    $Condition="";
		else
                    $Condition=" WHERE ".$Condition;

		if($AliasFieldName == ''){
			$getField = $FieldName;
		}
		else{
			$getField = $AliasFieldName;
			$FieldName = $FieldName ." AS ".$AliasFieldName;
		}

		$sql = "SELECT ".$FieldName." FROM ".$TableName.$Condition;
                //echo $sql; exit;
		$rs = $this->db->query($sql);

		if($rs->num_rows())
		{
			$rec = $rs->row();

			if(is_numeric($rec->$getField))
			{
				if($rec->$getField > 0)
					return $rec->$getField;
				else
					return "0";
			}
			else{
				return $rec->$getField;
			}
		}else{
			return false;
		}
	}

    public function getValues_conditions($TableName, $FieldNames, $Condition=''){
        if($Condition=="")
            $Condition="";
        else
            $Condition=" WHERE ".$Condition;
        $select = implode(",", $FieldNames);
        $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
        $rs = $this->db->query($sql);
        if($rs->num_rows()){
            return $rs->result_array();
        }else{
                return false;
        }
    }

	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = '')
	{
		if($condition == '') $condition = 1;

		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
                //echo $sql;exit;

		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." > '".$idValue."'";
		}

		$rs = $this->db->query($sql);

		$rec = $rs->row();
		$cnt = $rec->CNT;

		return $cnt;
	}


	public function populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy)
	{
		$sql = "SELECT ".$idField.", ".$nameField." FROM ".$tableName." WHERE ".$condition." ORDER BY ".$orderField." ".$orderBy."";
		$rs = $this->db->query($sql);

		if($rs->num_rows())
        {
            $rec = $rs->result_array();
			return $rec;
        }

		return false;
	}

	public function getSingle($tableName, $whereCondition)
	{
		if($whereCondition <> '')
			$where = " WHERE ".$whereCondition;
		else
			$where = " WHERE 1 ";

		$sql = "SELECT * FROM ".$tableName." ".$where." ";
		$rs = $this->db->query($sql);

		if($rs->num_rows())
		{
		    $rec = $rs->result();
				return $rec;
		}

		return false;
	}
	
	public function deleteRecord($tableName, $condition_arr = array())
	{
		$this->db->where($condition_arr);
		$this->db->delete($tableName);
		return true;
	}

	
	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM dipp_sitesettings WHERE sitesettings_id in (".$id.") ";
		
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

	function detailsDB($table,$condition_arr=array(),$selectField='*',$order ='',$order_by ='',$startLimit='',$endLimit=''){
		$this->db->select($selectField);
		$this->db->from($table);
		$this->db->where($condition_arr);
		if($order != '')
		$this->db->order_by($order, $order_by);
		if($startLimit!='' && $endLimit!='')
		$this->db->limit($endLimit,$startLimit);
		$query=$this->db->get();
		return $query->result_array();
	}
}