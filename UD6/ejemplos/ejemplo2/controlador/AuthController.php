<?php
include_once(PATH_MODEL.'AuthModel.php');
class AuthController{

    public static function checkAuth($endpoint, $method, $token):bool{
        $auth = false;
        if(isset($endpoint) && isset($method) && isset($token)){
            $auth = AuthModel::hasAccess($endpoint, $method, $token);
        }
        return $auth;
    }
}