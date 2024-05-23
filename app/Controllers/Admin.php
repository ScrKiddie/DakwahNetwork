<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\DakwahModel;
use App\Models\PenyelenggaraModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;
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
        if (!$this->validation->run($addPenyelenggaraRequest,"penyelenggaraRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect("admin/penyelenggara/new");
        }
        $file = $this->request->getFile("profilePict");
        if (isset($file)){
            if ($file->isFile()){
                if (!$this->validation->run([],"fileRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors"=>$errors));
                    return redirect("admin/penyelenggara/new");
                }else{
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH."upload", $newFileName);
                    $addPenyelenggaraRequest["profilePict"] =  $newFileName;
                }
            }
        }
        $this->penyelenggaraModel->insert($addPenyelenggaraRequest);
        $this->session->setFlashdata(array("success"=>"menambahkan"));
        return redirect("admin/penyelenggara");
    }
    public function editPenyelenggara(){
        $idPenyelenggara = $this->request->getGet("id");
        if(!$this->validation->run(["id"=>$idPenyelenggara],"idPenyelenggaraRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $penyelenggaraById = $this->penyelenggaraModel->where("id",$idPenyelenggara)->findAll();
        return view("admin/editPenyelenggara",["data"=>$penyelenggaraById]);
    }

    public function updatePenyelenggara(){
        $editPenyelenggaraRequest=array(
            "id" => $this->request->getPost("id"),
            "email" => $this->request->getPost("email"),
            "username" => $this->request->getPost("username"),
            "namaLembaga" => $this->request->getPost("namaLembaga"),
            "alamatLembaga" => $this->request->getPost("alamatLembaga"),
            "noTelp" => $this->request->getPost("noTelp")
        );

        if ($this->request->getPost("password") !== ""){
            $editPenyelenggaraRequest["password"] = $this->request->getPost("password");
        }

        if (!$this->validation->run($editPenyelenggaraRequest,"editPenyelenggaraRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/penyelenggara/edit?id=". $this->request->getPost("id"));
        }

        $file = $this->request->getFile("profilePict");
        if (isset($file)){
            if ($file->isFile()){
                if (!$this->validation->run([],"fileRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors"=>$errors));
                    return redirect()->to(base_url()."admin/penyelenggara/edit?id=". $this->request->getPost("id"));
                }else{
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH."upload", $newFileName);
                    $editPenyelenggaraRequest["profilePict"] =  $newFileName;
                    //hapus file lama
                    $fileById=$this->penyelenggaraModel->where("id", $editPenyelenggaraRequest["id"])->select("profilePict")->findAll();
                    $fileNameById=$fileById[0]["profilePict"];
                    $filePath = FCPATH . 'upload/' . $fileNameById;
                    if ($fileNameById!="default.jpg" && file_exists($filePath)){
                        unlink($filePath);
                    }

                }
            }
        }

        $this->penyelenggaraModel->update($editPenyelenggaraRequest["id"],$editPenyelenggaraRequest);
        $this->session->setFlashdata(array("success"=>"mengubah"));
        return redirect("admin/penyelenggara");
    }
    public function deletePenyelenggara(){
        $idPenyelenggara = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idPenyelenggara],"idPenyelenggaraRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $fileById=$this->penyelenggaraModel->where("id", $idPenyelenggara)->select("profilePict")->findAll();
        $fileNameById=$fileById[0]['profilePict'];
        $filePath = FCPATH . 'upload/' . $fileNameById;
        try {
            if($this->penyelenggaraModel->where("id", $idPenyelenggara)->delete()){
                //hapus file lama
                if ($fileNameById!="default.jpg" && file_exists($filePath)){
                    unlink($filePath);
                }
                $response = service('response');
                $response->setStatusCode(200);
                return $response;
            }
        } catch (DatabaseException $e) {
            if ($e->getCode() == 1451) {
                return service('response')->setStatusCode(409);
            } else {
                return service('response')->setStatusCode(500);
            }
        }


    }
}