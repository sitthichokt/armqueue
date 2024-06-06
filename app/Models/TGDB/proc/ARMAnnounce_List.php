<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARMAnnounce_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id;
    public $Display_Type ='Running';
    public $Announce_Page='';
    public $Announce_status='';
    /**
     * @param int Agent_Id
     * @param string Display_Type
     * @param string Announce_Page
     * @param string Announce_status
     */

    public function get()
    {         
        $storedProc = "EXEC ARMAnnounce_List  @Agent_Id= ?, @Display_Type= ?, @Announce_Page= ?, @Announce_status= ?";
        $params     = [$this->Agent_Id,
                        $this->Display_Type,
                        $this->Announce_Page,
                        $this->Announce_status];
        $query      = $this->db->query($storedProc, $params);
        if($this->Display_Type==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }

        return $results;      
    }


    /**
     * @param int Agent_Id
     * @param string Announce_Page
     */
    public function del()
    {   $this->db->transOff();
        $this->db->transBegin();     
        $storedProc = "EXEC ARMAnnounce_List  @Agent_Id= ?, @Display_Type= ?, @Announce_Page= ?, @Announce_status= ?";
        $params     = [$this->Agent_Id,
                        'Delete',
                        $this->Announce_Page,
                        $this->Announce_status];
        $query      = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            return false;
        } else {		
            $this->db->transCommit();
            unset($query);	
            return true;
        }
    }
}