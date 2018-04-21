<?php
use Symfony\Component\HttpFoundation\Session\Session;
use Legato\Framework\TwigGlobal;
use Philo\Blade\Blade;

if (! function_exists('view')) {
    function view($view, $data = []):void
    {
        $template = getenv('TEMPLATE_ENGINE');
        
        if(getenv('FRAMEWORK') == 'developer'){
            $path_to_views = realpath(__DIR__ . '/../../resources/views');
        }else{
            $path_to_views = realpath(__DIR__.'/../../../../../resources/views');
        }
        
        switch ($template)
        {
            case 'blade':
                
                if(file_exists(realpath(__DIR__.'/../../../../../resources/views'))){
                    $cache = realpath(__DIR__.'/../../../../../cache/blade');
                }else{
                    $cache = realpath(__DIR__ . '/../../cache/blade');
                }
                
                $blade = new Blade($path_to_views, $cache);
                echo $blade->view()->make($view, $data)->render();
                break;
                
            default:
            $loader = new \Twig_Loader_Filesystem($path_to_views);
            $twig = new \Twig_Environment($loader);
            //$twig->addGlobal('notice', flash(new Session, 'notice'));
            $twig->addExtension(new TwigGlobal);

            try{
                echo $twig->render($view, $data);
            }catch (Exception $exception){
                die($exception->getMessage());
            }
        }
    }
}

if (! function_exists('redirectTo')) {
    function redirectTo($path)
    {
        //ob_start();
        header("Location: $path");
    }
}

if (! function_exists('flash')) {
    function flash(Session $session, $name):string
    {
        foreach ($session->getFlashBag()->get($name, array()) as $message) {
            return $message?:null;
        }

        return '';
    }
}