<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงหรือซ่อนเมนู QCMonitoring */
class ARMKM_Encrypt extends Model
{
	protected $DBGroup = 'tgdb';

    public function encrypt():string
    {
        $P_Agent_Id = session()->get('agent')['agent_id'];
        $query           = $this->db->query('select dbo.ARMKM_Encrypt('.$P_Agent_Id.') as encrypt');
        $results         = $query->getRowArray();
        return $results['encrypt'];		
	}
}