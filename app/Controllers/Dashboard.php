<?php

namespace App\Controllers;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function admin()
    {
        return view('index');
        // $this->load->view('templates/index');
        // $this->load->view('templates/sidebar');
        // $this->load->view('templates/footer');


    }
}