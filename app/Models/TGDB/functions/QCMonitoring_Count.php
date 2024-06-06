<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class QCMonitoring_Count extends Model
{
	protected $DBGroup = 'tgdb';

    public function get_mesgnumber() {
        $P_Agent_Id = session()->get('agent')['agent_id'];
        $query           = $this->db->query('select dbo.QCMonitoring_Count('.$P_Agent_Id.') as qcmnum');
        $results         = $query->getRowArray();
        return $results['qcmnum'];		
	}
}