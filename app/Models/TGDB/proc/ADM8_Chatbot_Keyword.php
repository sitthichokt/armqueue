<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_Keyword extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $Social_type = '';
    public $Page_Id     = '';
    public $ScreenType  = 'List';

    /**
     * @param Agent_Id
     * @param Social_type
     * @param Page_Id
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM8_Chatbot_Keyword  @Agent_Id=?,@Social_type=?,@Page_Id=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Social_type,
                        $this->Page_Id,
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