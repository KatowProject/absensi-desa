<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'role_id',
        'name',
        'email',
        'password',
        'jabatan_id',
        'jenis_kelamin',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_all()
    {
        return $this
            ->select('user.id, user.role_id, user.name, user.email, user.jenis_kelamin, role.name as role, jabatan.name as jabatan')
            ->join('role', 'role.id = user.role_id')
            ->join('jabatan', 'jabatan.id = user.jabatan_id')
            ->orderBy('jabatan.id', 'ASC')
            ->findAll();
    }

    public function get_by_id($id)
    {
        return $this
            ->select('user.*, role.name as role, jabatan.name as jabatan')
            ->join('role', 'role.id = user.role_id')
            ->join('jabatan', 'jabatan.id = user.jabatan_id')
            ->where('user.id', $id)
            ->first();
    }
}
