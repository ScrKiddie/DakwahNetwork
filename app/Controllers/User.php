<?php

namespace App\Controllers;

use App\Models\DakwahModel;
use App\Models\PenyelenggaraModel;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;
use DateTime;
use DateTimeZone;

class User extends BaseController
{
    private PenyelenggaraModel $penyelenggaraModel;
    private DakwahModel $dakwahModel;
    private Validation $validation;
    private Session $session;
    private array $userData;

    function __construct()
    {
        $this->penyelenggaraModel = new PenyelenggaraModel();
        $this->dakwahModel = new DakwahModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();

        helper('cookie');
        $token_parts = explode('.', get_cookie("token"));
        $payload = base64_decode($token_parts[1]);
        $payloadArray = json_decode($payload, true);
        $user = $this->penyelenggaraModel->where("id", $payloadArray['id'])->select("*")->findAll();
        $this->userData = array("id" => $user[0]["id"], "username" => $user[0]["username"], "profilePict" => $user[0]["profilePict"]);
    }

    function dashboard()
    {
        $dakwahActiveCount = $this->dakwahModel->where("status", "active")->where("id_penyelenggara", $this->userData["id"])->countAllResults();
        $dakwahInactiveCount = $this->dakwahModel->where("status", "inactive")->where("id_penyelenggara", $this->userData["id"])->countAllResults();
        return view("user/dashboard", [$dakwahActiveCount, $dakwahInactiveCount, "userData" => $this->userData]);
    }

    function dakwah()
    {
        $dakwahAktif = $this->dakwahModel->where("status", "active")->where("id_penyelenggara", $this->userData["id"])->findAll();
        date_default_timezone_set('Asia/Jakarta');
        foreach ($dakwahAktif as &$value) {
            $value["waktuMulai"] = date('Y-m-d\TH:i', $value["waktuMulai"]);
            $value["durasi"] = $value["durasi"] . " Menit";
        }
        return view("user/dakwah", ["data" => $dakwahAktif, "userData" => $this->userData]);
    }

    function historiDakwah()
    {
        $dakwahAktif = $this->dakwahModel->where("status", "inactive")->where("id_penyelenggara", $this->userData["id"])->findAll();
        foreach ($dakwahAktif as &$value) {
            $value["waktuMulai"] = date('Y-m-d\TH:i', $value["waktuMulai"]);
            $value["durasi"] = $value["durasi"] . " Menit";
        }
        return view("user/historiDakwah", ["data" => $dakwahAktif, "userData" => $this->userData]);
    }

    function newDakwah()
    {
        return view("user/addDakwah", ["userData" => $this->userData]);
    }

    function addDakwah()
    {
        $addDakwahRequest = array(
            "judul" => $this->request->getPost("judul"),
            "tema" => $this->request->getPost("tema"),
            "waktuMulai" => $this->request->getPost("waktuMulai"),
            "durasi" => $this->request->getPost("durasi"),
            "pendakwah" => $this->request->getPost("pendakwah"),
            "deskripsi" => $this->request->getPost("deskripsi"),
            "lokasi" => $this->request->getPost("lokasi"),
            "id_penyelenggara" => $this->userData["id"],
            "status" => "active"
        );
        if (!$this->validation->run($addDakwahRequest, "dakwahRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect()->to(base_url() . "user/dakwah/new");
        }
        $file = $this->request->getFile("posterPict");
        if (!$this->validation->run([], "posterAddRule")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect()->to(base_url() . "user/dakwah/new");
        } else {
            $fileExtension = $file->getClientExtension();
            $newFileName = uniqid() . "." . $fileExtension;
            $file->move(FCPATH . "upload", $newFileName);
            $addDakwahRequest["posterPict"] = $newFileName;
        }
        $dateTime = new DateTime($addDakwahRequest["waktuMulai"], new DateTimeZone('Asia/Jakarta'));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        $givenDateTime = $dateTime->getTimestamp();
        $addDakwahRequest["waktuMulai"] = $givenDateTime;
        $this->dakwahModel->insert($addDakwahRequest);
        $this->session->setFlashdata(array("success" => "menambahkan"));
        return redirect("user/dakwah");
    }

    function editDakwah()
    {
        $idDakwah = $this->request->getGet("id");
        if (!$this->validation->run(["id" => $idDakwah, "id_penyelenggara" => $this->userData["id"]], "idDakwahRuleUser")) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->where("id_penyelenggara", $this->userData["id"])->select("status")
            ->findAll()[0];
        if ($statusAkun["status"] == "inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $dakwahById = $this->dakwahModel->where("id", $idDakwah)->findAll();
        date_default_timezone_set('Asia/Jakarta');
        $dakwahById[0]["waktuMulai"] = date('Y-m-d\TH:i', $dakwahById[0]["waktuMulai"]);
        return view("user/editDakwah", ["data" => $dakwahById, "userData" => $this->userData]);
    }

    function updateDakwah()
    {
        $idDakwah = $this->request->getPost("id");
        if (!$this->validation->run(["id" => $idDakwah, "id_penyelenggara" => $this->userData["id"]], "idDakwahRuleUser")) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->where("id_penyelenggara", $this->userData["id"])->select("status")
            ->findAll()[0];
        if ($statusAkun["status"] == "inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $updateDakwahRequest = array(
            "judul" => $this->request->getPost("judul"),
            "tema" => $this->request->getPost("tema"),
            "waktuMulai" => $this->request->getPost("waktuMulai"),
            "durasi" => $this->request->getPost("durasi"),
            "pendakwah" => $this->request->getPost("pendakwah"),
            "deskripsi" => $this->request->getPost("deskripsi"),
            "lokasi" => $this->request->getPost("lokasi"),
            "id_penyelenggara" => $this->userData["id"],
            "status" => "active"
        );
        if (!$this->validation->run($updateDakwahRequest, "dakwahRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect()->to(base_url() . "user/dakwah/edit?id=" . $idDakwah);
        }

        $file = $this->request->getFile("posterPict");
        //optional
        if (isset($file)) {
            if ($file->isFile()) {
                if (!$this->validation->run([], "posterUpdateRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors" => $errors));
                    return redirect()->to(base_url() . "user/dakwah/edit?id=" . $idDakwah);
                } else {
                    //hapus
                    $fileById = $this->dakwahModel->where("id", $idDakwah)->select("posterPict")->findAll();
                    $fileNameById = $fileById[0]['posterPict'];
                    $filePath = FCPATH . 'upload/' . $fileNameById;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH . "upload", $newFileName);
                    $updateDakwahRequest["posterPict"] = $newFileName;
                }
            }
        }
        $dateTime = new DateTime($updateDakwahRequest["waktuMulai"], new DateTimeZone('Asia/Jakarta'));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        $givenDateTime = $dateTime->getTimestamp();
        $updateDakwahRequest["waktuMulai"] = $givenDateTime;
        $this->dakwahModel->update($idDakwah, $updateDakwahRequest);
        $this->session->setFlashdata(array("success" => "mengubah"));
        return redirect("user/dakwah");

    }

    public function deleteDakwah()
    {
        $idDakwah = $this->request->getPost("id");
        if (!$this->validation->run(["id" => $idDakwah, "id_penyelenggara" => $this->userData["id"]], "idDakwahRuleUser")) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $fileById = $this->dakwahModel->where("id", $idDakwah)->select("posterPict")->findAll();
        $fileNameById = $fileById[0]['posterPict'];
        $filePath = FCPATH . 'upload/' . $fileNameById;
        if ($this->dakwahModel->where("id", $idDakwah)->delete()) {
            //hapus file lama
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        }
    }

    public function doneDakwah()
    {
        $idDakwah = $this->request->getPost("id");
        if (!$this->validation->run(["id" => $idDakwah, "id_penyelenggara" => $this->userData["id"]], "idDakwahRuleUser")) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $statusAkun = $this->dakwahModel->where('id', $idDakwah)->where("id_penyelenggara", $this->userData["id"])->select("status")
            ->findAll()[0];
        if ($statusAkun["status"] == "inactive") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if ($this->dakwahModel->update($idDakwah, ["status" => "inactive"])) {
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        }
    }

    public function userProfile()
    {
        $penyelenggaraById = $this->penyelenggaraModel->where("id", $this->userData["id"])->findAll();
        return view("user/profileUser", ["data" => $penyelenggaraById, "userData" => $this->userData]);
    }

    public function saveUserProfile()
    {
        $editUserRequest = array(
            "id" => $this->userData["id"],
            "email" => $this->request->getPost("email"),
            "username" => $this->request->getPost("username"),
            "namaLembaga" => $this->request->getPost("namaLembaga"),
            "alamatLembaga" => $this->request->getPost("alamatLembaga"),
            "noTelp" => $this->request->getPost("noTelp")
        );

        if (!$this->validation->run($editUserRequest, "editPenyelenggaraRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect()->to(base_url() . "user/profile");
        }

        $file = $this->request->getFile("profilePict");
        //optional
        if (isset($file)) {
            if ($file->isFile()) {
                if (!$this->validation->run([], "fileRule")) {
                    $errors = $this->validation->getErrors();
                    $this->session->setFlashdata(array("errors" => $errors));
                    return redirect()->to(base_url() . "user/profile");
                } else {
                    $fileExtension = $file->getClientExtension();
                    $newFileName = uniqid() . "." . $fileExtension;
                    $file->move(FCPATH . "upload", $newFileName);
                    $editUserRequest["profilePict"] = $newFileName;
                    //hapus file lama
                    $fileById = $this->penyelenggaraModel->where("id", $editUserRequest["id"])->select("profilePict")->findAll();
                    $fileNameById = $fileById[0]["profilePict"];
                    $filePath = FCPATH . 'upload/' . $fileNameById;
                    if ($fileNameById != "default.jpg" && file_exists($filePath)) {
                        unlink($filePath);
                    }

                }
            }
        }

        $this->penyelenggaraModel->update($editUserRequest["id"], $editUserRequest);
        $this->session->setFlashdata(array("success" => "mengubah"));
        return redirect("user/profile");
    }

    public function passwordUser()
    {
        return view("user/password", ["userData" => $this->userData]);
    }

    public function updatePasswordUser()
    {
        $userRequest = array(
            "id" => $this->userData["id"],
            "oldPass" => hash("sha256", $this->request->getPost("oldPass")),
            "newPass" => $this->request->getPost("newPass"),
            "repeatNewPass" => $this->request->getPost("repeatNewPass"),
        );
        if (!$this->validation->run($userRequest, "userPasswordRule")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect()->to(base_url() . "user/password");
        }
        $userRequest["newPass"] = hash("sha256", $userRequest["newPass"]);
        $this->penyelenggaraModel->update($userRequest["id"], ["password" => $userRequest["newPass"]]);
        $this->session->setFlashdata(array("success" => "mengubah"));
        return redirect("user/password");
    }

    public function logoutUser()
    {
        if (isset($_COOKIE['token'])) {
            unset($_COOKIE['token']);
            setcookie('token', '', time() - 3600, '/');
            return redirect("user/login");
        } else {
            redirect("user/login");
        }
    }
}