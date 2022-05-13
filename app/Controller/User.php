<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;
use Base\Db;
use Base\View;

class User extends AbstractController
{
    public $users;
    public $user;
    public $view;

    public function loginAction()
    {
        $name = trim($_POST['name']);

        if ($name) {
            $password = $_POST['password'];
            $user = UserModel::getByName($name);
            if (!$user) {
                $this->view->assign('error', 'Неверный логин и пароль');
            }

            if ($user) {
                if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                    $this->view->assign('error', 'Неверный логин и пароль');
                } else {
                    $_SESSION['id'] = $user->getId();
                    $this->redirect('/posts/index');
                }
            }
        }

        return $this->view->render('User/register.twig', [
            'user' => UserModel::getById((int)$_GET['id'])
        ]);
    }

    public function registerAction()
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $gender = UserModel::GENDER_MALE;
        $password = trim($_POST['password']);
        $password_r = trim($_POST['password_r']);


        $success = true;
        if (isset($_POST['name'])) {

            if (!$name) {
                $this->view->assign('error', 'Имя не может быть пустым');
                $success = false;
            }

            if (!$password || (strlen($password) <= 4)) {
                $this->view->assign('error', 'Пароль не может быть пустым и меньше 4 символов');
                $success = false;
            }

            if ($password != $password_r) {
                $this->view->assign('error', 'Пароль не подтвержден');
                $success = false;
            }

            if (!$email) {
                $this->view->assign('error', 'Email не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByName($name);
            if ($user) {
                $this->view->assign('error', 'Пользователь с таким именем уже существует');
                $success = false;
            }

            if ($success) {
                $user = (new UserModel())->setName($name)->setEmail($email)->setGender($gender)->setPassword(UserModel::getPasswordHash($password));

                $user->save();

                $_SESSION['id'] = $user->getId();
                $this->setUser($user);

                $this->redirect('/posts/index');
            }
        }
        return $this->view->render('User/register.twig', [
        ]);
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.twig', [
            'user' => UserModel::getById((int)$_GET['id'])
        ]);

    }

    public function logoutAction()
    {
        session_destroy();

        $this->redirect('/user/login');

    }

    public function deleteUserAction()
    {
        $id = ($_POST['id']);
        $user = (new UserModel())->setId($id);
        $user->delete();
        $this->redirect('/posts/index');

        return $this->view->render('Blog/blog.twig', [
            'user' => $this->user,
        ]);
    }

    public function updateUserAction()
    {
        $id = ($_POST['id']);
        $name = ($_POST['name']);
        $email = ($_POST['email']);
        $password = ($_POST['password']);

        $user = UserModel::getById($id);

        $user->name = $name;
        $user->email = $email;
        $user->password = UserModel::getPasswordHash($password);

        $user->updates($user->id,$user->name,$user->email,$user->password);

        $this->redirect('/posts/index');

        return $this->view->render('Blog/blog.twig', [
            'user' => $this->user,
        ]);
    }
}