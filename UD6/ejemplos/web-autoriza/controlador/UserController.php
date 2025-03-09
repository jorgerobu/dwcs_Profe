<?php

namespace webautoriza\controlador;

require_once("Controller.php");
require_once(PATH_MODEL . "UsuarioModel.php");

use webautoriza\controlador\Controller;
use webautoriza\model\UsuarioModel;

class UserController extends Controller
{

    public function login()
    {
        //Si ya esta logueado lo enviamos a 
        $this->view->show('login');
    }

    public function checkLogin()
    {
        //Si ya está logueado lo enviamos al listado de tokens.
        if (isset($_SESSION['loged'])) {
            header('Location: ' . PATH_ROOT . '?controller=token&action=getTokens');
            die();
        }

        if (!isset($_POST['user']) || empty($_POST['user']) || !isset($_POST['pass']) || empty($_POST['pass'])) {
            $data['errores'] = ['Los campos usuario y contraseña son obligatorios'];
            $this->view->show('login', $data);
        } else {
            $usr = UsuarioModel::getUserByPass($_POST['user'], $_POST['pass']);
            if ($usr) {
                $_SESSION['loged'] = $usr;
                header('Location: ' . PATH_ROOT . '?controller=token&action=getTokens');
            } else {
                $data['errores'] = ['El usuario y/o la contraseña no son correctos.'];
                $this->view->show('login', $data);
            }
        }
    }

    public function signin()
    {
        $this->view->show('signin');
    }

    public function addUser()
    {
        $errores = [];
        //Validacion de campos obligatorios
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            $errores[] = ['El nombre es obligatorio'];
        }

        if (!isset($_POST['apellido1']) || empty($_POST['apellido1'])) {
            $errores[] = ['El primer apellido es obligatorio'];
        }

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $errores[] = ['El email es obligatorio'];
        }

        if (!isset($_POST['pass']) || empty($_POST['pass'])) {
            $errores[] = ['La contraseña es obligatoria'];
        }

        if (!isset($_POST['pass2']) || empty($_POST['pass2'])) {
            $errores[] = ['Debe repetir la contraseña.'];
        }
        //Validación de las contraseñas iguales.
        if ($_POST['pass'] != $_POST['pass2']) {
            $errores[] = ['Las contraseñas no coinciden'];
        }

        //Comprobar que el usuario no existe.
        $users = UsuarioModel::getUsersByUserEmail($_POST['user'], $_POST['email']);
        if ($users) {
            $mailExists = false;
            $userExists = false;
            foreach ($users as $u) {
                if ($u->user == $_POST['user']) {
                    $errores[] = ['Nombre de usuario no disponible'];
                    $userExists = true;
                }

                if ($u->user == $_POST['user']) {
                    $errores[] = ['Ya existe un usuario con ese nombre'];
                    $mailExists = true;
                }
            }
            if ($userExists) {
                $errores[] = ['Nombre de usuario no disponible'];
            }

            if ($mailExists) {
                $errores[] = ['El email ya está registrado.'];
                $mailExists = true;
            }
        }

        //Registrar el usuario si no hay errores.
        $vista = 'signin';
        if (
            count($errores) == 0
            && UsuarioModel::addUser($_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['email'], $_POST['user'], $_POST['pass'])
        ) {
            $vista = 'login';
        }

        $this->view->show($vista, $errores);
    }

    public function logOut()
    {
        session_unset();
        session_destroy();
        header('Location: '.PATH_ROOT);
    }
}
