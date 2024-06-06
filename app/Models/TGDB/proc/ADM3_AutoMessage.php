<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class ADM3_AutoMessage extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $AGroup_Id;
    public $Message_Status;
    public $ScreenType = 'List';

   
    /**
     * @param Agent_Id
     * @param AGroup_Id
     * @param Message_Status
     */
    public function list()
    {
        $storedProc = "EXEC ADM3_AutoMessage  @Agent_Id= ?,@AGroup_Id= ?,@Message_Status= ?,@ScreenType= ?";
        $params     = [
            $this->Agent_Id,
            $this->AGroup_Id,
            $this->Message_Status,
            $this->ScreenType,
        ];
        $query      = $this->db->query($storedProc, $params);
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        return $results;
        
    }
}