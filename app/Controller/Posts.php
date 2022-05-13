<?php

namespace App\Controller;

use App\Model\Posts as PostsModel;
use App\Model\User as UserModel;
use Base\AbstractController;
use Base\Db;
use Intervention\Image\ImageManagerStatic as Image;

class Posts extends AbstractController
{
    public $posts;
    public $blogs;
    public $posts_user_id;
    public $posts_name;

    protected static $_imagePath;

    public static function create_article ($text, $user_id) {
        $arr = array(
            "texts" => $texts,
            'user_id' => $user_id
        );
        $post = Posts::create($arr);
        return $posts;
    }

    public function indexAction()
    {
        if (!$this->user) {
            $this->redirect('/user/register');
        }

        return $this->view->render('Blog/index.twig', [
            'user' => $this->user
        ]);
    }

    public function allpostsAction()
    {
        if (!$this->user) {
            $this->redirect('/user/register');
        }

        $this->users = UserModel::getAll();
        $this->posts = PostsModel::getAll();
        $this->posts_name = PostsModel::getNamePostSender();

        return $this->view->render('Blog/blog.twig', [
            'users' => $this->users,
            'user' => $this->user,
            'posts' => $this->posts,
            'posts_name' => $this->posts_name,
            'ADMIN' => ADMIN
        ]);
    }

    public function sendPostAction()
    {
        $message = htmlspecialchars(trim($_POST['message']));
        $user_id = $_SESSION['id'];
        $createdAt = date("Y-m-d H:i:s");

        $success = true;
        if (isset($_POST['message'])) {

            if (!$message) {
                $this->view->assign('error', 'Текст не может быть пустым');
                $success = false;
            }

            if ($success) {
                $blogs = (new PostsModel())->setUserId($user_id)->setText($message)/*->setCreatedAt($createdAt)*/;

                $blogs->save();

                $sendPostUserId = $blogs->getId();

                if (!empty($_FILES['userfile']['tmp_name'])) {
                    $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);
                    file_put_contents('images/' . $sendPostUserId . '.png', $fileContent);
                }

                $this->redirect('/posts/index');
            }
        }

        return $this->view->render('Blog/blog.twig', [
            'user' => $this->user,
        ]);
    }

    public function deletePostAction()
    {
        $id = ($_POST['id']);
        $blogs = (new PostsModel())->setId($id);
        $blogs->delete();
        $this->redirect('/posts/index');

        return $this->view->render('Blog/blog.twig', [
            'user' => $this->user,
        ]);
    }

    public function apiAction()
    {
        $user_id_api = ((int)$_POST['user_id_api']);

        if (!$this->user) {
            $this->redirect('/user/register');
        }

        $this->posts = PostsModel::getAll();
        $this->posts_name = PostsModel::getNamePostSender();
        $this->posts_user_id = PostsModel::getAllById($user_id_api);

        return $this->view->render('Blog/blog.twig', [
            'user' => $this->user,
            'posts' => $this->posts,
            'posts_name' => $this->posts_name,
            'posts_user_id' => $this->posts_user_id,
            'ADMIN' => ADMIN
        ]);
    }

 /*   public function preAction()
    {
        parent::preAction();
        $this->noRender();
        self::$_imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . 'images/';
    }
*/
    public function imageAction()
    {

        $source = (self::$_imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . 'images/').'23.jpg';
        $result = (self::$_imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . 'images/').'23_new.jpg';
        $image = Image::make($source)
            ->resize(200, 200, function ($image) {
                $image->aspectRatio();
            })
            //->rotate(45)
            ->blur(1)
            ->crop(200, 200)
            //->invert()
            //->fit(400, 100)
            ->save($result, 80);

        //$image->save($result, 80);
        //echo 'success';

        self::watermark($image);

        echo $image->response('png');
    }

    public static function watermark(\Intervention\Image\Image $image)
    {
        $image->text(
            "Это WATERMARK",
            5,
            15,
            function ($font) {
                $font->file((self::$_imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . 'images/').'arial.ttf')->size('24'); //требуется расширение freetype
                $font->color(array(255, 0, 0, 0.5));
                $font->align('left');
                $font->valign('top');
            });
    }


}