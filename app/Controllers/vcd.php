<?php
namespace App\Controllers;

//memanggil model
use App\Models\BukuModel;
use App\Models\KategoriModel;

class vcd extends BaseController
{
    public function __construct()
    {
        //load model untuk digunakan
        $this->VcdModel = new VcdModel();
        $this->KategoriModel = new KategoriModel();
    }

    public function list()
    {
        //select data from table vcd
        $list = $this->VcdModel->select('Vcd.id, Vcd.judul, kategori.nama AS kategori_nama')->join('kategori','vcd.kategori_id = kategori.id')->orderBy('kategori.nama, judul')->findAll();

        $output = [
            'list' => $list,
        ];

        return view('vcd_list', $output);
    }

    public function insert()
    {
        //select data from table kategori (untuk data di selectbox/dropdown)
        $data_kategori = $this->KategoriModel->orderBy('nama')->findAll();

        $output = [
            'data_kategori' => $data_kategori,
        ];

        return view('vcd_insert', $output);
    }

    public function insert_save()
    {
        $genre_id = $this->request->getVar('genre_id');
        $judul = $this->request->getVar('judul');

        //insert data ke table buku
        $this->VcdModel->insert([
            'genre_id' => $genre_id,
            'judul' => $judul,
        ]);

        return redirect()->to('vcd');
    }

    public function update($id)
    {
        //select data kategori yang dipilih (filter by id)
        $data =  $this->VcdModel->where('id', $id)->first();
        
        //select data from table kategori (untuk data di selectbox/dropdown)
        $data_kategori = $this->KategoriModel->orderBy('nama')->findAll();

        $output = [
            'data' => $data,
            'data_kategori' => $data_kategori,
        ];

        return view('buku_update', $output);
    }

    public function update_save($id)
    {
        $genre_id = $this->request->getVar('genre_id');
        $judul = $this->request->getVar('judul');

        //update data ke table buku filter by id
        $this->BukuModel->update($id, [
            'genre_id' => $genre_id,
            'judul' => $judul,
        ]);

        return redirect()->to('vcd/');
    }

    public function delete($id)
    {   
        //delete data table buku filter by id
        $this->VcdModel->delete($id);
        return redirect()->to('vcd');
    }
}