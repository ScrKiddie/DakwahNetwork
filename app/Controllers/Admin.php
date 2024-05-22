<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\DakwahModel;
use App\Models\PenyelenggaraModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;

class Admin extends Controller
{
    private PenyelenggaraModel $penyelenggaraModel;
    private DakwahModel $dakwahModel;
    private Validation $validation;
    private Session $session;
    function __construct()
    {
        $this->penyelenggaraModel = new PenyelenggaraModel();
        $this->dakwahModel = new DakwahModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function dashboard(){
        $penyelenggaraCount = $this->penyelenggaraModel->countAllResults();
        $dakwahCount = $this->dakwahModel->countAllResults();
        return view("admin/dashboard",[$penyelenggaraCount,$dakwahCount]);
    }
    public function penyelenggara(){
        $penyelenggaraAktif = $this->penyelenggaraModel->where("status","Aktif")->findAll();
        return view("admin/penyelenggara",["data"=>$penyelenggaraAktif]);
    }
    public function newPenyelenggara(){
        return view("admin/addPenyelenggara");
    }
    public function addPenyelenggara(){
        $addPenyelenggaraRequest=array(
            "email" => $this->request->getPost("email"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password"),
            "namaLembaga" => $this->request->getPost("namaLembaga"),
            "alamatLembaga" => $this->request->getPost("alamatLembaga"),
            "noTelp" => $this->request->getPost("noTelp"),
            "profilePict" => "default.jpg",
            "status" => "aktif",
        );
        if (!$this->validation->run($addPenyelenggaraRequest,'addPenyelenggaraRequest')) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect('admin/penyelenggara/new');
        }
        $file = $this->request->getFile('profilePict');
        if (isset($file)){
            if ($file->isFile()){
                if (!$this->validation->run([],'testFile')) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors"=>$errors));
                    return redirect('admin/penyelenggara/new');
                }else{
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . '.' . $fileExtension;
                    $file->move(ROOTPATH . 'public/img', $newFileName);
                    $addPenyelenggaraRequest["profilePict"] =  $newFileName;
                }
            }
        }
        $this->penyelenggaraModel->insert($addPenyelenggaraRequest);
        $this->session->setFlashdata(array("success"=>"menambahkan"));
        return redirect('admin/penyelenggara');
    }
}