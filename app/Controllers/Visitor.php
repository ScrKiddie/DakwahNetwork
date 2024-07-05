<?php

namespace App\Controllers;

use App\Models\DakwahModel;
use App\Models\MessagesModel;
use CodeIgniter\Validation\Validation;

class Visitor extends BaseController
{
    private DakwahModel $dakwahModel;
    private MessagesModel $messagesModel;
    private Validation $validation;

    public function __construct()
    {
        $this->dakwahModel = new DakwahModel();
        $this->messagesModel = new MessagesModel();
        $this->validation = \Config\Services::validation();
    }

    function dakwah()
    {
        $allData = $this->dakwahModel->getDakwahWithPenyelenggara();
        date_default_timezone_set('Asia/Jakarta');
        foreach ($allData as &$value) {
            $value["waktuMulai"] = date('M d, Y (H:i)', $value["waktuMulai"]);
        }
        return view("visitor/dakwah", ["data" => $allData]);
    }

    function beranda()
    {
        return view("visitor/beranda");
    }

    function contact()
    {
        return view("visitor/contact");
    }

    function sendContact()
    {
        $messageRequest = array(
            "name" => $this->request->getPost("name"),
            "email" => $this->request->getPost("email"),
            "subject" => $this->request->getPost("subject"),
            "message" => $this->request->getPost("message"),
        );
        if (!$this->validation->run($messageRequest, "messageRequestRules")) {
            $response = service('response');
            $response->setStatusCode(404);
            $errors = $this->validation->getErrors();
            var_dump($errors);
            return $response;
        }
        if ($this->messagesModel->insert($messageRequest)) {
            $response = service('response');
            $response->setStatusCode(200);
            return $response;
        } else {
            $response = service('response');
            $response->setStatusCode(500);
            return $response;
        }

    }
}