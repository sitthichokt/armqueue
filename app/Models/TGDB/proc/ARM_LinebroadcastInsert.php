<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARM_LinebroadcastInsert extends Model
{
    protected $DBGroup = 'tgdb';
    public $ArCust_Id     = '';
    public $CustSocial_Id = '';
    public $Broad_Title   = '';
    public $Broad_Link    = '';
    public $Broad_DESC    = '';
    public $Broad_Image   = '';
    public $Broad_Date    = '';
    public $Status        = '';
    public $Create_By     = '';
    public $Create_Date   = '';
    public $Update_By     = '';
    public $Update_Date   = '';



    /**
     * @param ArCust_Id
     * @param CustSocial_Id
     * @param Broad_Title
     * @param Broad_Link
     * @param Broad_DESC
     * @param Broad_Image
     * @param Broad_Date
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
        $storedProc = "EXEC ARM_LinebroadcastInsert @ArCust_Id=?,@CustSocial_Id=?,@Broad_Title=?,@Broad_Link=?,@Broad_DESC=N?,@Broad_Image=?,@Broad_Date=?,@Status=?,@Create_By=?,@Create_Date=?,@Update_By=?,@Update_Date=?";
        $params     = [$this->ArCust_Id,
                        $this->CustSocial_Id,
                        $this->Broad_Title,
                        $this->Broad_Link,
                        $this->Broad_DESC,
                        $this->Broad_Image,
                        $this->Broad_Date,
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