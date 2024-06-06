<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_Message extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $Page_Id     = '';
    public $Social_Type = '';
    public $ScreenType  = 'List';


    /**
     * @param Agent_Id
     * @param Page_Id
     * @param Social_Type
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM8_Chatbot_Message  @Agent_Id=?,@Page_Id=?,@Social_Type=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Page_Id,
                        $this->Social_Type,
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