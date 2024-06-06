<?php

namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Ticket_Social_Datatable extends Model
{
    protected $DBGroup = 'tgdb';

    // กรณีเลือก P_forder หรือ P_ticket_status ต้องเลือกอย่างใดอย่างหนึ่ง
    public function get($Agent_Id,$CustSocial_Id,$start,$length,$P_Search='',$P_forder='',$P_ticket_status='') {
        $storedProc = "EXEC Ticket_Social_Datatable @CustSocial_Id=?, @start=?, @length=?, @P_Search=?, @P_forder=?, @P_ticket_status=?, @Agent_Id=?";
        $params     = [$CustSocial_Id
                        ,$start
                        ,$length
                        ,$P_Search
                        ,$P_forder
                        ,$P_ticket_status
                        ,$Agent_Id];
		$query      = $this->db->query($storedProc, $params);

        unset($CustSocial_Id,$start,$length,$P_Search,$P_forder,$P_ticket_status);       
        $data			= $query->getNextRowArray(0); 
		$data['table']  = $query->getNextRowArray(1); 
		return $data;
      
	}

    public function get_datatable($Agent_Id,$CustSocial_Id,$P_Search='',$P_forder='',$P_ticket_status='') {
        $storedProc = "EXEC Ticket_Social_Datatable_limit @CustSocial_Id=?, @P_Search=?, @P_forder=?, @P_ticket_status=?, @Agent_Id=?";
        $params     = [$CustSocial_Id
                        ,$P_Search
                        ,$P_forder
                        ,$P_ticket_status
                        ,$Agent_Id];
		$query      = $this->db->query($storedProc, $params);

        unset($CustSocial_Id,$start,$length,$P_Search,$P_forder,$P_ticket_status);       
        // $data			= $query->getNextRowArray(0); 
		$data['table']  = $query->getResultArray(); 
		return $data;
      
	}
}