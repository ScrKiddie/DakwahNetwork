<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class UserAuthorization implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $privateKey = "ISI_SECRET_KEY_USER";
        $cookies = $request->getCookie("token");
        if (isset($cookies)) {
            try {
                $decoded = JWT::decode($cookies, new Key($privateKey, 'HS256'));
            } catch (\Exception) {
                return redirect("user/login");
            }
        } else {
            return redirect("user/login");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}