<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_BotML_TrainData extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $Page_Id     = '';
    public $Social_Type = '';
    public $Message     = '';
    public $ScreenType  = 'List';

    /**
     * @param Agent_Id
     * @param Page_Id
     * @param Social_Type
     * @param Message
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM8_BotML_TrainData  @Agent_Id=?,@Page_Id=?,@Social_Type=?,@Message=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Page_Id,
                        $this->Social_Type,
                        $this->Message,
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