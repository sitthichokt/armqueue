<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class PhoneCall_Manage extends Model
{
    protected $DBGroup = 'tgdb';

    public $Search = '';
    public $CustSocial = 0;

    /**
     * @param string Search
     */
    public function search()
    {
        $storedProc = "EXEC PhoneCall_Manage @S_Search=?, @S_CustSocial=?";
        $params     = [$this->Search, $this->CustSocial];
      
        $query  = $this->db->query($storedProc, $params);
        $data   = ['user'=>[], 'ticket'=>[]];

        if(!empty($query) && $query->getNumRows()>0){
            $query->getNextRowArray();
			$data['user']   = $query->getNextRowArray(0); 
			$data['ticket'] = $query->getNextRowArray(1);
		}

        return $data;
    }
}