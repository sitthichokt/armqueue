<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Fn_AgentRole extends Model
{
	protected $DBGroup = 'tgdb';

    public function get_mesgnumber() {
        $P_Agent_Id = session()->get('agent')['agent_id'];
        $query           = $this->db->query('select dbo.Fn_AgentRole('.$P_Agent_Id.') as agentrole');
        $results         = $query->getRowArray();
        return $results['agentrole'];		
	}
}