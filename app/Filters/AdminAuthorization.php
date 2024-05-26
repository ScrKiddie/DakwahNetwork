<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class AdminAuthorization implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $privateKey = "secret_key_admin";
        $cookies = $request->getCookie("token");
        if (isset($cookies)) {
            try {
                $decoded = JWT::decode($cookies, new Key($privateKey, 'HS256'));
            }catch (\Exception){
                return redirect("admin/login");
            }
        }else{
            return redirect("admin/login");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}