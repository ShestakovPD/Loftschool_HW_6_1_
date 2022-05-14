<?php

namespace Base;

use App\Controller\User;

class Application
{
    private $route;
    /** @var AbstractController */
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
            session_start();
            $this->addRoutes();
            $this->initController();
            $this->initAction();

            $view = new View();
            $this->controller->setView($view);
            $this->initUser();

            $content = $this->controller->{$this->actionName}();

            echo $content;

        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
            die;
        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage();
        }
    }

    private function initUser()
    {
        $id = $_SESSION['id'] ?? null;
        if ($id) {
            $user = \App\Model\Eloquent\User::getById($id);
            if ($user) {
                $this->controller->setUser($user);
            }
        }
    }

    private function addRoutes()
    {
        ///** @uses \App\Controller\User::loginAction() */
        $this->route->addRoute('/user/go', User::class, 'login');
        $this->route->addRoute('/', User::class, 'login');
        ///** @uses \App\Controller\User::registerAction() */
        $this->route->addRoute('/user/register', User::class, 'register');
        $this->route->addRoute('/posts/updateUser', User::class, 'updateUser');
        ///** @uses \App\Controller\Blog::indexAction() */
        $this->route->addRoute('/posts', \App\Controller\Posts::class, 'index');
        $this->route->addRoute('/posts/index', \App\Controller\Posts::class, 'index');
        $this->route->addRoute('/posts/allPosts', \App\Controller\Posts::class, 'AllPosts');
        $this->route->addRoute('/pre', \App\Controller\Posts::class, 'image');
        /*Db\getLogHTML();*/
    }

    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) {
            throw new RouteException('Cant find controller ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new RouteException('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }
}