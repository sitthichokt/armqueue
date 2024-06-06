<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class AnswerSheet_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $ARCust_Id='';
    public $CaseCreate_from;
    public $CaseCreate_to;
    public $Title;

    /**
     * @param int ARCust_Id
     * @param datetime CaseCreate_from
     * @param datetime CaseCreate_to
     * @param varchar Title
     */
    public function list()
    {
        $storedProc = "EXEC AnswerSheet_List @ARCust_Id=?,@Display_Type=?,@CaseCreate_from=?,@CaseCreate_to=?,@Title=?";
        $params     = [
            $this->ARCust_Id,
            'List',
            $this->CaseCreate_from,
            $this->CaseCreate_to,
            $this->Title,
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;    
    }


}