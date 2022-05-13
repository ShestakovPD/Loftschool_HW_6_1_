<?php

namespace Base;

use App\Model\User;
use Twig;


/**
 * Class View
 * @package Base
 *
 */
class View
{
    private $templatePath = '';
    private $data = [];
    public  $tpl = '';

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function getTwig()
    {
        if (!$this->_twig)
            $loader = new \Twig\Loader\FilesystemLoader($this->templatePath);
            $this->_twig = new \Twig\Environment(
                $loader,[
                'debug' => true
            ]
            /*   ['cache' => $path . '_cache', 'autoescape' => false]*/
            );

        return $this->_twig;
    }

    public function render(string $tpl, $data = []): string
    {

        $this->data += $data;
        /*ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();*/

            $twig = $this->getTwig();
            $twig->addExtension(new \Twig\Extension\DebugExtension());
            $twig->addGlobal('post', $_POST);

            ob_start(null, null,  PHP_OUTPUT_HANDLER_STDFLAGS );
                try {
                    echo $twig->render($tpl, $this->data + ['view' => $this]);

                } catch (\Exception $e) {
                    trigger_error($e->getMessage());
                }
                return ob_get_clean();
    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}