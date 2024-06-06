<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Dashboard_TaskMonitoring extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
  
    public function get()
    {
        helper('writable');
        $storedProc = "EXEC Dashboard_TaskMonitoring   @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);

        unset($storedProc,$params);

        $card = $query->getNextRowArrayAll(0); 
        $agent_active = $query->getNextRowArray(1); 
        $new_ticket_today = $query->getNextRowArray(2); 
        $pending_ticket_today = $query->getNextRowArray(3); 
        $pending_ticket_moreday = $query->getNextRowArray(4);
        unset($query);

        $data['card']	                = $card; 
		$data['agent_active']           = $agent_active; 
		$data['new_ticket_today']       = $new_ticket_today; 
		$data['pending_ticket_today']   = $pending_ticket_today; 
		$data['pending_ticket_moreday'] = $pending_ticket_moreday;
        return $data;
    }
}