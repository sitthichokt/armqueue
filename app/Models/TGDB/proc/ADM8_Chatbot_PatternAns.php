<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_PatternAns extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $Social_Type = '';
    public $Page_Id     = '';
    public $Message_Id  = '';
    public $ScreenType  = 'List';

    /**
     * @param Agent_Id
     * @param Social_Type
     * @param Page_Id
     * @param Message_Id
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM8_Chatbot_PatternAns @Agent_Id=?,@Social_Type=?,@Page_Id=?,@Message_Id=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Social_Type,
                        $this->Page_Id,
                        $this->Message_Id,
                        $this->ScreenType];
        $query      = $this->db->query($storedProc, $params);
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query,$storedProc,$params);
        return $results; 

    }
}