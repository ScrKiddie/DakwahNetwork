<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PenyelenggaraModel;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;
use CodeIgniter\Validation\Validation;
use CodeIgniter\Session\Session;
use Firebase\JWT\Key;

class Authentication extends Controller
{
    private Validation $validation;
    private Session $session;
    private AdminModel $adminModel;
    private PenyelenggaraModel $penyelenggaraModel;

    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->adminModel = new AdminModel();
        $this->penyelenggaraModel = new PenyelenggaraModel();
    }

    function adminAuthentication()
    {
        $autRequest = array(
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password")
        );
        if (!$this->validation->run($autRequest, "authRule")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect("admin/login");
        }
        $id = $this->adminModel->select("id")
            ->where("username", $this->request->getPost("username"))
            ->where("password", hash("sha256", $this->request->getPost("password")))
            ->findAll();
        if ($id == null) {
            $this->session->setFlashdata(array("errors" => ["" => "Username atau password salah"]));
            return redirect("admin/login");
        }
        $privateKey = "ISI_SECRET_KEY_ADMIN";
        $timestampNow = time();
        $timestampAdd1H = $timestampNow + 3600;
        $payload = [
            'id' => $id[0]["id"],
            'nbf' => $timestampNow,
            'iat' => $timestampAdd1H,
        ];
        $jwt = JWT::encode($payload, $privateKey, 'HS256');
        return redirect("admin/dashboard")->setCookie("token", $jwt, 3600, "", "", "", false, true, "");;
    }

    function adminLogin()
    {
        return view("admin/login");
    }

    function userAuthentication()
    {
        $autRequest = array(
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password")
        );
        if (!$this->validation->run($autRequest, "authRule")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect("user/login");
        }
        $autRequest["password"] = hash("sha256", $autRequest["password"]);
        $id = $this->penyelenggaraModel->select("id")
            ->groupStart()
            ->where("username", $autRequest["username"])
            ->orWhere("email", $autRequest["username"])
            ->groupEnd()
            ->where("password", $autRequest["password"])
            ->where("status", "active")
            ->findAll();
        if ($id == null) {
            $this->session->setFlashdata(array("errors" => ["" => "Username atau password salah"]));
            return redirect("user/login");
        }
        $privateKey = "ISI_SECRET_KEY_USER";
        $timestampNow = time();
        $timestampAdd1H = $timestampNow + 3600;
        $payload = [
            'id' => $id[0]["id"],
            'nbf' => $timestampNow,
            'iat' => $timestampAdd1H,
        ];
        $jwt = JWT::encode($payload, $privateKey, 'HS256');
        return redirect("user/dashboard")->setCookie("token", $jwt, 3600, "", "", "", false, true, "");;
    }

    function userLogin()
    {
        return view("user/login");
    }

    function userRegister()
    {
        return view("user/register");
    }

    function userRegistering()
    {
        $addPenyelenggaraRequest = array(
            "email" => $this->request->getPost("email"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password"),
            "namaLembaga" => $this->request->getPost("namaLembaga"),
            "alamatLembaga" => $this->request->getPost("alamatLembaga"),
            "noTelp" => $this->request->getPost("noTelp"),
            "profilePict" => "default.jpg",
            "status" => "inactive",
        );
        if (!$this->validation->run($addPenyelenggaraRequest, "penyelenggaraRules")) {
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors" => $errors));
            return redirect("user/register");
        }
        $addPenyelenggaraRequest["password"] = hash("sha256", $addPenyelenggaraRequest["password"]);
        $this->penyelenggaraModel->insert($addPenyelenggaraRequest);
        $this->session->setFlashdata(array("success" => "membuat"));
        return redirect("user/register");
    }

}