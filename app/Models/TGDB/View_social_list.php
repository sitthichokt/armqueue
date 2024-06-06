<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class View_social_list extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    public $Agroup_Id='';
    public $Agent_Id_E='';

    /**
     * @param int Agent_Id
     * @param int Agroup_Id
     * @param int Agent_Id_E
     */
    public function list()
    {
        $storedProc = "select * from view_social_list";
        $query      = $this->db->query($storedProc);
        $results    = $query->getResultArray();
        return $results;
    }
}