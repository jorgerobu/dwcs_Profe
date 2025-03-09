<?php
include_once(PATH_MODEL.'AuthModel.php');

class AuthController{
    public static function checkAuth($token, $endpoint, $method):bool{
        $auth = false;
        if(isset($endpoint) && isset($method) && isset($token)){
            $auth = AuthModel::hasAccess($endpoint, $method, $token);
        }
        return $auth;
    }
}