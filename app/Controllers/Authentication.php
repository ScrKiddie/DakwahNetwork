<?php
namespace App\Controllers;
use App\Models\AdminModel;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;
use CodeIgniter\Validation\Validation;
use CodeIgniter\Session\Session;
use Firebase\JWT\Key;

class Authentication extends Controller{
    private Validation $validation;
    private Session $session;
    private AdminModel $adminModel;
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->adminModel = new AdminModel();
    }

    function adminAuthentication(){
        $autRequest=array(
            "username"=>$this->request->getPost("username"),
            "password"=>$this->request->getPost("password")
        );
        if(!$this->validation->run($autRequest,"authRule")){
            $errors = $this->validation->getErrors();
            $this->session->setFlashdata(array("errors"=>$errors));
            return redirect("admin/login");
        }
        $id=$this->adminModel->select("id")
        ->where("username",$this->request->getPost("username"))
        ->where("password",$this->request->getPost("password"))
        ->findAll();
        if($id==null){
            $this->session->setFlashdata(array("errors"=>[""=>"Username atau password salah"]));
            return redirect("admin/login");
        }
        $privateKey = "akahjuwifwabafiwufwbaiuafwbuiawffwaawf";
        $timestampNow = time();
        $timestampAdd1H = $timestampNow+3600;
        $payload = [
            'id' => $id[0]["id"],
            'nbf' => $timestampNow,
            'iat' => $timestampAdd1H,
        ];
        $jwt = JWT::encode($payload, $privateKey, 'HS256');
        return redirect("admin/dashboard")->setCookie("token",$jwt,3600,"","","",false,true,"");;
    }
    function adminLogin(){
        return view("admin/login");
    }

}