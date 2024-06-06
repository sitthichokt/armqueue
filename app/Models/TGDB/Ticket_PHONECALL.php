<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_PHONECALL extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_PHONECALL';
    protected $primaryKey = 'Ticket_Phone_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_Phone_Id',
        'Ticket_Id',
        'Parent_Id',
        'Sub_Comment',
        'CustUser_Id',
        'Agent_Id',
        'Who_Comment',
        'Chat_Comment_Id',
        'Message_Status',
        'Phone_Number',
        'Phone_Message',
        'Phone_CreateDate',
        'Channel_Id',
        'ContactChannel_Others',
        'Appointment_Date',
        'Appointment_Time',
        'FollowUp',
        'Follow_Note',
        'Update_By',
        'Delete_By',
        'Update_Date',
        'Delete_Date',
        'End_Call_Survey',
        'Note_End_Call',
        'Media_Id',
        'Media_Others',
        'Media_Sub_Id',
        'End_Call_Id'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
}