<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARMAnnounce_Insert extends Model
{
    protected $DBGroup = 'tgdb';
    public $ArCust_Id          = '';
    public $CustSocial_Id      = '';
    public $Announce_Title     = '';
    public $Announce_Link      = '';
    public $Announce_DESC      = '';
    public $Announce_Startdate = '';
    public $Announce_enddate   = '';
    public $Status             = '';
    public $Create_By          = '';
    public $Create_Date        = '';
    public $Update_By          = '';
    public $Update_Date        = '';

    /**
     * @param ArCust_Id
     * @param CustSocial_Id
     * @param Announce_Title
     * @param Announce_Link
     * @param Announce_DESC
     * @param Announce_Startdate
     * @param Announce_enddate
     * @param Status
     * @param Create_By
     * @param Create_Date
     * @param Update_By
     * @param Update_Date
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARMAnnounce_Insert @ArCust_Id=?,@CustSocial_Id=?,@Announce_Title=?,@Announce_Link=?,@Announce_DESC=?,@Announce_Startdate=?,@Announce_enddate=?,@Status=?,@Create_By=?,@Create_Date=?,@Update_By=?,@Update_Date=?";
        $params     = [$this->ArCust_Id,
                        $this->CustSocial_Id,
                        $this->Announce_Title,
                        $this->Announce_Link,
                        $this->Announce_DESC,
                        $this->Announce_Startdate,
                        $this->Announce_enddate,
                        $this->Status,
                        $this->Create_By,
                        $this->Create_Date,
                        $this->Update_By,
                        $this->Update_Date];
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