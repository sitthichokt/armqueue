<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Shopee_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Shopee_Attachment';
    protected $primaryKey = 'Shopee_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Shopee_Att_Id'
        , 'Ticket_Id'
        , 'Ticket_Shopee_Id'
        , 'Shopee_Att_Url'
        , 'Shopee_Att_Part'
        , 'Shopee_Att_OldName'
        , 'Shopee_Att_NewName'
        , 'Shopee_Att_Type'
        , 'Shopee_Att_extension'
        , 'Shopee_Att_status'
        , 'Shopee_Att_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Shopee_Att_CreateDate';
    protected $updatedField  = 'Shopee_Att_CreateDate';
}