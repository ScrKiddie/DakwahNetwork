<?php

namespace App\Controllers;
use App\Models\MessagesModel;
use CodeIgniter\Email\Email;
use DateTime;
use DateTimeZone;
use App\Models\DakwahModel;
use App\Models\AdminModel;
use App\Models\PenyelenggaraModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;

class Admin extends Controller
{
    private PenyelenggaraModel $penyelenggaraModel;
    private AdminModel $adminModel;
    private DakwahModel $dakwahModel;
    private Validation $validation;
    private Session $session;
    private Email $email;
    private array $adminData;
    private MessagesModel $messagesModel;

    function __construct()
    {
        $this->messagesModel= new MessagesModel();
        $this->penyelenggaraModel = new PenyelenggaraModel();
        $this->adminModel = new AdminModel();
        $this->dakwahModel = new DakwahModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();

        //kebutuhan navbar
        helper('cookie');
        $token_parts = explode('.', get_cookie("token"));
        $payload =base64_decode($token_parts[1]);
        $payloadArray = json_decode($payload, true);
        $adminModel = new AdminModel();
        $admin = $adminModel->where("id",$payloadArray['id'])->select("*")->findAll();
        $this->adminData = array("id"=>$admin[0]["id"],"username"=>$admin[0]["username"],"profilePict"=>$admin[0]["profilePict"]);
    }


    public function dashboard(){
        $penyelenggaraActiveCount = $this->penyelenggaraModel->where("status","active")->countAllResults();
        $penyelenggaraInactiveCount = $this->penyelenggaraModel->where("status","inactive")->countAllResults();
        $dakwahActiveCount = $this->dakwahModel->where("status","active")->countAllResults();
        $dakwahInactiveCount = $this->dakwahModel->where("status","inactive")->countAllResults();
        return view("admin/dashboard",[$penyelenggaraActiveCount,$penyelenggaraInactiveCount,$dakwahActiveCount,$dakwahInactiveCount,"adminData"=>$this->adminData]);
    }
    public function penyelenggara(){
        $penyelenggaraAktif = $this->penyelenggaraModel->where("status","active")->findAll();
        return view("admin/penyelenggara",["data"=>$penyelenggaraAktif,"adminData"=>$this->adminData]);
    }
    public function newPenyelenggara(){
        return view("admin/addPenyelenggara",["adminData"=>$this->adminData]);
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
        $addPenyelenggaraRequest["password"]=hash("sha256",$addPenyelenggaraRequest["password"]);

        $file = $this->request->getFile("profilePict");
        //optional
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
        return view("admin/editPenyelenggara",["data"=>$penyelenggaraById,"adminData"=>$this->adminData]);
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

        $statusAkun = $this->penyelenggaraModel->where('id', $editPenyelenggaraRequest["id"])->select("status")
            ->findAll()[0];
        if ($statusAkun=="inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost("password") !== ""){
            $editPenyelenggaraRequest["password"] = hash("sha256",$this->request->getPost("password"));
        }

        if (!$this->validation->run($editPenyelenggaraRequest,"editPenyelenggaraRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/penyelenggara/edit?id=". $this->request->getPost("id"));
        }

        $file = $this->request->getFile("profilePict");
        //optional
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
        $email = $this->penyelenggaraModel->where('id', $idPenyelenggara)->select("email")
            ->findAll()[0];
        try {
            if($this->penyelenggaraModel->where("id", $idPenyelenggara)->delete()){
                //hapus file lama
                if ($fileNameById!="default.jpg" && file_exists($filePath)){
                    unlink($filePath);
                }
                $this->email->setFrom($this->email->SMTPHost, 'DakNet');
                $this->email->setTo($email);
                $this->email->setSubject('Penonaktifan Akun DakNet');
                $this->email->setMessage(view("admin/adminNonAktifMail"));
                $this->email->setMailType('html');

                if ($this->email->send()) {
                    return service('response')->setStatusCode(200);
                } else {
                    return service('response')->setStatusCode(500);
                }
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
        return view("admin/registeredPenyelenggara",["data"=>$penyelenggaraNonaktif,"adminData"=>$this->adminData]);
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
        $email = $this->penyelenggaraModel->where('id', $idPenyelenggara)->select("email")
            ->findAll()[0];
        try {
            if($this->penyelenggaraModel->update($idPenyelenggara,["status"=>"active"])){
                $this->email->setFrom($this->email->SMTPHost, 'DakNet');
                $this->email->setTo($email);
                $this->email->setSubject('Penerimaan Pendaftaran Akun DakNet');
                $this->email->setMessage(view("admin/adminAcceptMail"));
                $this->email->setMailType('html');
                if ($this->email->send()) {
                    return service('response')->setStatusCode(200);
                } else {
                    return service('response')->setStatusCode(500);
                }
            }
        } catch (DatabaseException $e) {
            return service('response')->setStatusCode(500);
        }
    }
    function dakwah(){
        $dakwahAktif = $this->dakwahModel->where("status","active")->findAll();
        date_default_timezone_set('Asia/Jakarta');
        foreach ($dakwahAktif as &$value){
            $value["waktuMulai"]= date('Y-m-d\TH:i', $value["waktuMulai"]);
            $value["durasi"]= $value["durasi"]." Menit";
        }
        return view("admin/dakwah",["data"=>$dakwahAktif,"adminData"=>$this->adminData]);
    }
    function newDakwah(){
        $namaLembaga = $this->penyelenggaraModel->select("id")->select("namaLembaga")->where("status","active")->findAll();
        return view("admin/addDakwah",["data"=>$namaLembaga,"adminData"=>$this->adminData]);
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
        //not optional
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
        $dateTime = new DateTime($addDakwahRequest["waktuMulai"], new DateTimeZone('Asia/Jakarta'));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        $givenDateTime = $dateTime->getTimestamp();
        $addDakwahRequest["waktuMulai"]=$givenDateTime;
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

        $namaLembaga = $this->penyelenggaraModel->select("id")->select("namaLembaga")->where("status","active")->findAll();
        $dakwahById = $this->dakwahModel->where("id",$idDakwah)->findAll();
        date_default_timezone_set('Asia/Jakarta');
        $dakwahById[0]["waktuMulai"]= date('Y-m-d\TH:i', $dakwahById[0]["waktuMulai"]);
        return view("admin/editDakwah",["data"=>$dakwahById,"data2"=>$namaLembaga,"adminData"=>$this->adminData]);
    }

    function updateDakwah(){
        $idDakwah = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idDakwah],"idDakwahRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->select("status")
            ->findAll()[0];
        if ($statusAkun["status"]=="inactive") {
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
        //optional
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
        $dateTime = new DateTime($updateDakwahRequest["waktuMulai"], new DateTimeZone('Asia/Jakarta'));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        $givenDateTime = $dateTime->getTimestamp();
        $updateDakwahRequest["waktuMulai"]=$givenDateTime;
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

    function historiDakwah(){
        $dakwahAktif = $this->dakwahModel->where("status","inactive")->findAll();
        foreach ($dakwahAktif as &$value){
            $value["waktuMulai"]= date('Y-m-d\TH:i', $value["waktuMulai"]);
            $value["durasi"]= $value["durasi"]." Menit";
        }
        return view("admin/historiDakwah",["data"=>$dakwahAktif,"adminData"=>$this->adminData]);
    }

    public function doneDakwah(){
        $idDakwah = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idDakwah],"idDakwahRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->select("status")
            ->findAll()[0];
        if ($statusAkun["status"]=="inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if($this->dakwahModel->update($idDakwah, ["status"=>"inactive"])){
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        }
    }
    public function adminProfile(){
       return view("admin/profileAdmin",["adminData"=>$this->adminData]);
    }
    public function saveAdminProfile(){
        $adminRequest=array(
            "id"=>$this->adminData["id"],
            "username"=>$this->request->getPost("username"),
        );
        if (!$this->validation->run($adminRequest,"adminRule")){
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/profile");
        }

        $file = $this->request->getFile("profilePict");
        //optional
        if (isset($file)){
            if ($file->isFile()){
                if (!$this->validation->run([],"fileRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors"=>$errors));
                    return redirect()->to(base_url()."admin/profile" );
                }else{
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH."upload", $newFileName);
                    $adminRequest["profilePict"] =  $newFileName;
                    //hapus
                    $fileById=$this->adminModel->where("id", $this->adminData["id"])->select("profilePict")->findAll();
                    $fileNameById=$fileById[0]['profilePict'];
                    $filePath = FCPATH . 'upload/' . $fileNameById;
                    if ($fileNameById!="default.jpg" && file_exists($filePath)){
                        unlink($filePath);
                    }
                }
            }
        }

        $this->adminModel->update($this->adminData["id"],$adminRequest);
        $this->session->setFlashdata(array("success"=>"mengubah"));
        return redirect("admin/profile");
    }
    public function passwordAdmin(){
        return view("admin/password",["adminData"=>$this->adminData]);
    }
    public function updatePasswordAdmin(){
        $adminRequest = array(
            "id"=>$this->adminData["id"],
            "oldPass"=> $this->request->getPost("oldPass"),
            "newPass"=> $this->request->getPost("newPass"),
            "repeatNewPass"=> $this->request->getPost("repeatNewPass"),
        );
        if (!$this->validation->run($adminRequest,"adminPasswordRule")){
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect()->to(base_url()."admin/password");
        }
        $this->adminModel->update($adminRequest["id"],["password"=>$adminRequest["newPass"]]);
        $this->session->setFlashdata(array("success"=>"mengubah"));
        return redirect("admin/password");
    }
    public function logoutAdmin(){
        if (isset($_COOKIE['token'])) {
            unset($_COOKIE['token']);
            setcookie('token', '', time() - 3600, '/');
            return redirect("admin/login");
        }else{
            redirect("admin/login");
        }
    }
    public function feedback(){
        $messages = $this->messagesModel->findAll();
        return view("admin/feedback",["data"=>$messages,"adminData"=>$this->adminData]);
    }

    public function feedbackDelete(){
        $idMessage = $this->request->getPost("id");
        if(!$this->validation->run(["id"=>$idMessage],"idMessagesRule")){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if($this->messagesModel->where("id", $idMessage)->delete()){
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        }
    }


}