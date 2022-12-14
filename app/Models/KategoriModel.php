<?php
namespace App\Models;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'genre';
    protected $allowedFields = ['genre_id','nama_genre'];
}