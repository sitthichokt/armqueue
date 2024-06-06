<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงหรือซ่อนเมนู QCMonitoring */
class ARM_PhoneAutoAssignAgent extends Model
{
	protected $DBGroup = 'tgdb';
    public $Agent_id = 0;
    public $Social_Id;
    public $Transfer = 0;

    public function get():string
    {
        $query           = $this->db->query('select dbo.ARM_PhoneAutoAssignAgent('.$this->Agent_id.','.$this->Social_Id.','.$this->Transfer.') as agent');
        $results         = $query->getRowArray();
        return $results['agent'];		
	}
}