<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** เรียกข้อมูลการส่ง mail contacthistory*/
class ADM8_BotML_BotAnswerEdit_GetData extends Model
{
    protected $DBGroup = 'tgdb';
    public    $MLQuest_Id ='';

    /**
     * @param int MLQuest_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM8_BotML_BotAnswerEdit_GetData  @MLQuest_Id= ?";
        $params     = [ $this->MLQuest_Id];
        $query      = $this->db->query($storedProc, $params);
		$data['ml_detail']    = $query->getNextRowArray(0); 
		$data['ml_question']  = $query->getNextRowArray(1); 
        return $data;
        
    }
}