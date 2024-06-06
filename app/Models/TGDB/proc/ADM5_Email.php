<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM5_Email extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $status  = '';
    
    /**
     * @param Agent_Id
     * @param status
     */
    public function get()
    {
        $storedProc = "EXEC ADM5_Email @Agent_Id=?,@status=?";
        $params     = [$this->Agent_Id,
                        $this->status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc);
        return $results;   

   
    }
}