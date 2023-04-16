<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['login', 'password'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tstamp_create';
    protected $updatedField  = 'tstamp_update';
    // protected $deletedField  = 'tstamp_delete';

    /*
    public function findAll() 
    { 
        return $this->orderBy("login",'DESC')->find(); 
    }
    */
}