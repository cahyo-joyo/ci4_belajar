<?php

namespace App\Models;

use CodeIgniter\Model;

class kotaModel extends Model
{
    protected $table = 'kota';
    protected $useTimestamps = true;
    protected $allowedFields = ['kota', 'provinsi', 'sejarah', 'icon'];

    public function getKota($provinsi = false)
    {
        if ($provinsi == false) {
            return $this->findAll();
        }
        return $this->where(['provinsi' => $provinsi])->first();
    }
}
