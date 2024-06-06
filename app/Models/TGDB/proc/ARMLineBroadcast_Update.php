<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARMLineBroadcast_Update extends Model
{
    protected $DBGroup = 'tgdb';
    public $CustSocial_Id = '';
    public $Broad_Title   = '';
    public $Broad_Link    = '';
    public $Broad_DESC    = '';
    public $Broad_date    = '';
    public $Broad_file    = '';
    public $Broad_Status  = '';
    public $Update_By     = '';
    public $Update_Date   = '';
    public $Broad_Id      = '';


    /**
     * @param CustSocial_Id
     * @param Broad_Title
     * @param Broad_Link
     * @param Broad_DESC
     * @param Broad_date
     * @param Broad_file
     * @param Broad_Status
     * @param Update_By
     * @param Update_Date
     * @param Broad_Id
     */
    public function upd()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARMLineBroadcast_Update @CustSocial_Id=?,@Broad_Title=?,@Broad_Link=?,@Broad_DESC=N?,@Broad_date=?,@Broad_file=?,@Broad_Status=?,@Update_By=?,@Update_Date=?,@Broad_Id=?";
        $params     = [$this->CustSocial_Id,
                        $this->Broad_Title,
                        $this->Broad_Link,
                        $this->Broad_DESC,
                        $this->Broad_date,
                        $this->Broad_file,
                        $this->Broad_Status,
                        $this->Update_By,
                        $this->Update_Date,
                        $this->Broad_Id];
        $query  = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();	
            return false;
        } else {		
            $this->db->transCommit();
            //$this->db->close();
            unset($query);	
            return true;
        }
    }

  
}