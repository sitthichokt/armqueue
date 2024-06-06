<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARM_LineBroadcast extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          = '';
    public $Display_Type      = 'List';
    public $CustSocial_Id     = '';
    public $Broadcast_status  = '';
    public $Broad_Id          = '';

    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param Broadcast_status
     * @param Broad_Id
     */
    public function get()
    {
        $storedProc = "EXEC ARM_LineBroadcast  @Agent_Id=?,@Display_Type=?,@CustSocial_Id=?,@Broadcast_status=?,@Broad_Id=?";
        $params     = [$this->Agent_Id,
                        $this->Display_Type,
                        $this->CustSocial_Id,
                        $this->Broadcast_status,
                        $this->Broad_Id];
        $query      = $this->db->query($storedProc, $params);
        if($this->Display_Type==='Edit'){
            $results    = $query->getRowArray();
        }else{
            $results    = $query->getResultArray();
        }      
        return $results;
        
    }
}