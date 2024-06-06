<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_FollowUp extends Model
{
    protected $DBGroup = 'tgdb';
 
    public $Agent_Id         = '';
    public $Follow_Status    = '';
    public $FType_Id         = '';
    public $Follow_Date_From = '';
    public $Follow_Date_To   = '';
    public $Create_Date_From = '';
    public $Create_Date_To   = '';
    public $CustSocial_Id    = '';
    public $FilterAgent_Id   = '';
    public $ScreenExcel      = 'SCREEN';
    public $getheader        = false;

    /**
     * @param bit getheader
     * @param int Agent_Id
     * @param varchar Follow_Status
     * @param int FType_Id
     * @param datetime Follow_Date_From
     * @param datetime Follow_Date_To
     * @param datetime Create_Date_From
     * @param datetime Create_Date_To
     * @param int CustSocial_Id
     * @param int FilterAgent_Id
     * @param varchar ScreenExcel (SCREEN,EXCEL)
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_FollowUp   @Agent_Id= ?,@Follow_Status= ?,@FType_Id= ?,@Follow_Date_From= ?,@Follow_Date_To= ?,@Create_Date_From= ?,@Create_Date_To= ?,@CustSocial_Id= ?,@FilterAgent_Id= ?,@ScreenExcel= ?";
        $params     = [$this->Agent_Id,
                       $this->Follow_Status,
                       $this->FType_Id,
                       $this->Follow_Date_From,
                       $this->Follow_Date_To,
                       $this->Create_Date_From,
                       $this->Create_Date_To,
                       $this->CustSocial_Id,
                       $this->FilterAgent_Id,
                       $this->ScreenExcel,];
        $query      = $this->db->query($storedProc, $params);
        if($this->getheader===true){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results   = $query->getResultArray();
        }
        return $results;     
    }

}