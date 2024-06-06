<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;

/** แสดงหรือซ่อนเมนู QCMonitoring */
class AutoHideBadWord extends Model
{
	protected $DBGroup = 'tgdb';
    public $message='';

    /**
     * @param string message
     */
    public function check_BadWord()
    {     	
        $query = 'select dbo.AutoHideBadWord(?) as status';
        $result = $this->db->query($query, array($this->message));
        $results         = $result->getRowArray();
        return $results['status'];
	}
}