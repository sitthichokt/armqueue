<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARMAnnounce_Update extends Model
{
    protected $DBGroup = 'tgdb';
    public $CustSocial_Id      ='';
    public $Announce_Title     ='';
    public $Announce_Link      ='';
    public $Announce_DESC      ='';
    public $Announce_Startdate ='';
    public $Announce_enddate   ='';
    public $Announce_Status    ='';
    public $Update_By          ='';
    public $Update_Date        ='';
    public $Announce_Id        ='';


    /**
     * @param CustSocial_Id
     * @param Announce_Title
     * @param Announce_Link
     * @param Announce_DESC
     * @param Announce_Startdate
     * @param Announce_enddate
     * @param Announce_Status
     * @param Update_By
     * @param Update_Date
     * @param Announce_Id
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARMAnnounce_Update @CustSocial_Id=?,@Announce_Title=?,@Announce_Link=?,@Announce_DESC=?,@Announce_Startdate=?,@Announce_enddate=?,@Announce_Status=?,@Update_By=?,@Update_Date=?,@Announce_Id=?";
        $params     = [$this->CustSocial_Id,
                        $this->Announce_Title,
                        $this->Announce_Link,
                        $this->Announce_DESC,
                        $this->Announce_Startdate,
                        $this->Announce_enddate,
                        $this->Announce_Status,
                        $this->Update_By,
                        $this->Update_Date,
                        $this->Announce_Id];
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