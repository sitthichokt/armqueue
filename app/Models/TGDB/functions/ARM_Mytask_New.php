<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงหรือซ่อนเมนู QCMonitoring */
class ARM_Mytask_New extends Model
{
	protected $DBGroup = 'tgdb';
    public $agent_id = '';

    public function get():int
    {
        $query           = $this->db->query('select dbo.ARM_Mytask_New('.$this->agent_id.') as new');
        $results         = $query->getRowArray();
        return $results['new'];		
	}
}