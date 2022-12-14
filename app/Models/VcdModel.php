<?php
namespace App\Models;
use CodeIgniter\Model;

class VcdModel extends Model
{
    protected $table = 'vcd';
    protected $allowedFields = ['id_vcd','judul','genre_id','harga'];
}