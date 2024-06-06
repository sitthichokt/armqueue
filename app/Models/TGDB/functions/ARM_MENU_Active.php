<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงหรือซ่อนเมนู QCMonitoring */
class ARM_MENU_Active extends Model
{
	protected $DBGroup = 'tgdb';

    public function get_mesgnumber(string $Filter):string
    {
        $P_Agent_Id = session()->get('agent')['agent_id'];
        $query           = $this->db->query('select dbo.ARM_MENU_Active('.$P_Agent_Id.',\''.$Filter.'\') as menuact');
        $results         = $query->getRowArray();
        return $results['menuact'];		
	}
}