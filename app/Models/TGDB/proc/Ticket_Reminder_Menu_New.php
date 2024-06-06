<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;
use DateTime;

class Ticket_Reminder_Menu_New extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $Follow_Status='';
    public $FType_Id=0;
    public $Follow_Date_From='';
    public $Follow_Date_To='';

    /**
     * @param Agent_Id
     * @param Follow_Status
     * @param FType_Id
     * @param Follow_Date_From
     * @param Follow_Date_To
     */
   
    public function get()
    {

        $datefrom = !empty($this->Follow_Date_From)?$this->Follow_Date_From:date('d/m/Y');
        $dateto   = !empty($this->Follow_Date_From)?$this->Follow_Date_To:date('d/m/Y');

        $myDateTimeFrom = DateTime::createFromFormat('d/m/Y', $datefrom);
        $newDateStringFrom = $myDateTimeFrom->format('Y-m-d');

        $myDateTimeTo = DateTime::createFromFormat('d/m/Y', $dateto);
        $newDateStringTo = $myDateTimeTo->format('Y-m-d');
      
        $storedProc = "EXEC Ticket_Reminder_Menu_New  @Agent_Id= ?,@Follow_Status= ?,@FType_Id= ?,@Follow_Date_From= ?,@Follow_Date_To= ?";
        $params     = [ $this->Agent_Id,
                        $this->Follow_Status,
                        $this->FType_Id,
                        $newDateStringFrom,
                        $newDateStringTo];
        $query      = $this->db->query($storedProc, $params);
    
        $data['total']          = $query->getNextRowArray(0); 
        $data['data']           = $query->getNextRowArray(1); 
        return  $data;
    }
}