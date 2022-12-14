<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function login()
    {
        return view('templates/login.html');
    }

    public function login_submit()
    {
        //ambil data dari form login
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        //aturan validasi
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[5]',
        ];

        //jika validasi gagal
        if (!$this->validate($rules)) {
            return redirect()->back()->with('validation', $this->validator);

        //jika validasi sukses
        } else {

            //check username & password enkripsi terdaftar di database
            $encrypt_password = sha1($password);
            $data = $this->UserModel->select('id, username, tipe, id_user')->where('username', $username)->where('password', $password)->first();
            
            if ($data) {
                //membuat session
                session()->set([
                    'username' => $data['username'],
                    'tipe' => $data['tipe'],
                    'petugas_id' => $data['petugas_id'],
                    'is_login' => TRUE
                ]);

                //jika tipe user : admin
                if($data['tipe'] == 'admin') {
                    return redirect()->to('/admin');

                //jika tipe user : petugas
                } else {
                    return redirect()->to('/');
                }
                

            } else {
                return redirect()->route('login')->with('error', 'Invalid login');
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}
