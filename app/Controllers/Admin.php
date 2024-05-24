<?php

namespace App\Controllers;

use App\Helpers\RequestHelper;
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
        $penyelenggaraActiveCount = $this->penyelenggaraModel->where("status","active")->countAllResults();
        $penyelenggaraInactiveCount = $this->penyelenggaraModel->where("status","inactive")->countAllResults();
        $dakwahActiveCount = $this->dakwahModel->where("status","active")->countAllResults();
        $dakwahInactiveCount = $this->dakwahModel->where("status","inactive")->countAllResults();
        return view("admin/dashboard",[$penyelenggaraActiveCount,$penyelenggaraInactiveCount,$dakwahActiveCount,$dakwahInactiveCount]);
    }
    public function penyelenggara(){
        $penyelenggaraAktif = $this->penyelenggaraModel->where("status","active")->findAll();
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
            "status" => "active",
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
        $statusAkun = $this->penyelenggaraModel->where('id', $idPenyelenggara)->select("status")
            ->findAll()[0];

        if ($statusAkun["status"]=="inactive") {
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
    public function registeredPenyelenggara(){
        $penyelenggaraNonaktif = $this->penyelenggaraModel->where("status","inactive")->findAll();
        return view("admin/registeredPenyelenggara",["data"=>$penyelenggaraNonaktif]);
    }

    public function acceptPenyelenggara(){
        $idPenyelenggara = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idPenyelenggara],"idPenyelenggaraRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->penyelenggaraModel->where('id', $idPenyelenggara)->select("status")
            ->findAll()[0];
        if ($statusAkun["status"]=="active") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        try {
            if($this->penyelenggaraModel->update($idPenyelenggara,["status"=>"active"])){
                $response = service('response');
                $response->setStatusCode(200);
                return $response;
            }
        } catch (DatabaseException $e) {
            return service('response')->setStatusCode(500);
        }
    }
    function dakwah(){
        $dakwahAktif = $this->dakwahModel->where("status","active")->findAll();
        foreach ($dakwahAktif as &$value){
            $value["waktuMulai"]= date('Y-m-d\TH:i', $value["waktuMulai"]);
            $value["durasi"]= $value["durasi"]." Menit";
        }
        return view("admin/dakwah",["data"=>$dakwahAktif]);
    }
    function newDakwah(){
        $namaLembaga = $this->penyelenggaraModel->select("id")->select("namaLembaga")->findAll();
        return view("admin/addDakwah",["data"=>$namaLembaga]);
    }
    function addDakwah(){
        $addDakwahRequest=array(
            "judul" =>$this->request->getPost("judul"),
            "tema" => $this->request->getPost("tema"),
            "waktuMulai" => $this->request->getPost("waktuMulai"),
            "durasi" => $this->request->getPost("durasi"),
            "pendakwah"=>$this->request->getPost("pendakwah"),
            "deskripsi"=>$this->request->getPost("deskripsi"),
            "lokasi"=>$this->request->getPost("lokasi"),
            "id_penyelenggara"=>$this->request->getPost("id_penyelenggara"),
            "status" => "active"
        );
        if (!$this->validation->run($addDakwahRequest,"dakwahRules")){
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/dakwah/new");
        }

        $file = $this->request->getFile("posterPict");
        if (!$this->validation->run([],"posterAddRule")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/dakwah/new");
        }else{
            $fileExtension = $file->getClientExtension();
            $newFileName = uniqid() . "." . $fileExtension;
            $file->move(FCPATH."upload", $newFileName);
            $addDakwahRequest["posterPict"] =  $newFileName;
        }
        $addDakwahRequest["waktuMulai"]=strtotime($addDakwahRequest["waktuMulai"]);
        $this->dakwahModel->insert($addDakwahRequest);
        $this->session->setFlashdata(array("success"=>"menambahkan"));
        return redirect("admin/dakwah");
    }
    function editDakwah(){
        $idDakwah = $this->request->getGet("id");
        if(!$this->validation->run(["id"=>$idDakwah],"idDakwahRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->select("status")
            ->findAll()[0];
        if ($statusAkun["status"]=="inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $namaLembaga = $this->penyelenggaraModel->select("id")->select("namaLembaga")->findAll();
        $dakwahById = $this->dakwahModel->where("id",$idDakwah)->findAll();
        $dakwahById[0]["waktuMulai"]= date('Y-m-d\TH:i', $dakwahById[0]["waktuMulai"]);
        return view("admin/editDakwah",["data"=>$dakwahById,"data2"=>$namaLembaga]);
    }

    function updateDakwah(){
        $idDakwah = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idDakwah],"idDakwahRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $updateDakwahRequest=array(
            "judul" =>$this->request->getPost("judul"),
            "tema" => $this->request->getPost("tema"),
            "waktuMulai" => $this->request->getPost("waktuMulai"),
            "durasi" => $this->request->getPost("durasi"),
            "pendakwah"=>$this->request->getPost("pendakwah"),
            "deskripsi"=>$this->request->getPost("deskripsi"),
            "lokasi"=>$this->request->getPost("lokasi"),
            "id_penyelenggara"=>$this->request->getPost("id_penyelenggara"),
            "status" => "active"
        );
        if (!$this->validation->run($updateDakwahRequest,"dakwahRules")){
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/dakwah/edit?id=".$idDakwah );
        }

        $file = $this->request->getFile("posterPict");
        if (isset($file)){
            if ($file->isFile()){
                if (!$this->validation->run([],"posterUpdateRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors"=>$errors));
                    return redirect()->to(base_url()."admin/dakwah/edit?id=".$idDakwah );
                }else{
                    //hapus
                    $fileById=$this->dakwahModel->where("id", $idDakwah)->select("posterPict")->findAll();
                    $fileNameById=$fileById[0]['posterPict'];
                    $filePath = FCPATH . 'upload/' . $fileNameById;
                    if (file_exists($filePath)){
                        unlink($filePath);
                    }
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH."upload", $newFileName);
                    $updateDakwahRequest["posterPict"] =  $newFileName;
                }
            }
        }

        $updateDakwahRequest["waktuMulai"]=strtotime($updateDakwahRequest["waktuMulai"]);
        $this->dakwahModel->update($idDakwah,$updateDakwahRequest);
        $this->session->setFlashdata(array("success"=>"mengubah"));
        return redirect("admin/dakwah");
    }
    public function deleteDakwah(){
        $idDakwah = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idDakwah],"idDakwahRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $fileById=$this->dakwahModel->where("id", $idDakwah)->select("posterPict")->findAll();
        $fileNameById=$fileById[0]['posterPict'];
        $filePath = FCPATH . 'upload/' . $fileNameById;
        if($this->dakwahModel->where("id", $idDakwah)->delete()){
            //hapus file lama
            if (file_exists($filePath)){
                unlink($filePath);
            }
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        }
    }
}