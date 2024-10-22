<?php
namespace App\Core;

use \Twig\Environment;
use Aura\Session\Segment;
use Aura\Session\SessionFactory;
use App\Menu\MenuReader;
use Knp\Menu\Renderer\ListRenderer;

/**
 * Description of renderer
 *
 * @author Chintan Parikh
 */
class Renderer {
    
    private \Twig\Environment $twigEnv;
    private \Http\Response $resp;
    private \Http\Request $req;
    private \App\Utils\Auth $auth;
    private \App\Utils\Router $router;
    public \Twig\Loader\FilesystemLoader $loader;
            
    function __construct(\Http\Request $req,\Http\Response $resp,\App\Utils\Auth $auth,\App\Utils\Router $router) {
        
        $this->req = $req;
        $this->resp = $resp;
        $this->auth = $auth;
        $this->router = $router;
        
        $this->loader = new \Twig\Loader\FilesystemLoader();
        
        $this->loader->addPath(dirname(__DIR__) . '/../templates');
        $this->loader->addPath(dirname(__DIR__).'/../vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views');
                
        
        $this->twigEnv = new \Twig\Environment($this->loader, [
            //'cache' => __DIR__."/../../cache",
            'extension' => '.twig',
        ]);
        
        
        //$GLOBALS['injector']->addCollector(new \DebugBar\Bridge\Twig\TwigCollector($env));
                
    }

    public function render($template, $data = [],$out = true)
    {
        $pendingActions = ["actions" => [],"emps" => []];
        $twgMenu = [];

        if($out) // It need to return in html then chances are its not a complete page render
        {

            $matcher = new \Knp\Menu\Matcher\Matcher();    
            $twgMenu = new \Knp\Menu\Renderer\TwigRenderer($this->twigEnv,"knp_menu.html.twig",$matcher);

            if($this->auth->isLogin() && $this->auth->getUser()->getEmployee()) {
                //On Hold
                $pendingActions = \Modules\System\Processes\WorkflowManager::getNotifications($this->auth->getUser()->getEmployee());                    
            }                

        }
        $session_factory = new SessionFactory;                
        $session = $session_factory->newInstance($_COOKIE)->getSegment(_SESSIONKEY);

        $widgetManager = new \Modules\System\Processes\Widgets($this->auth);
        
        $menuReader = new \App\Menu\ArrayMenuReader();
        
        if($this->auth->isLogin()){
                    $systemEvents = new \Modules\System\Processes\FrameworkEvents($this->auth);
                }
                $menu = $menuReader->readMenu();
                
                
        if($this->auth->isLogin()){
                    $menuReader->setMenu($systemEvents->perMenuRenderHook($menu));
                }
                
        $data = array_merge($data, [
                'menuItems' => $menuReader->writeMenu($this->router),
                'renderer' => $twgMenu,
                'router' => $this->router,
                'session' => $session,
                'site_title' => _SITETITLE,
                'auth' => $this->auth,
                'config' => $GLOBALS['config'],
                'request' => $this->req,
                'thumb' => $this->router->baseUrl('uploads/thumb.php'),
                'actions' => $pendingActions["actions"],
                'action_emps' => $pendingActions["emps"],
                'widgetmgr' => $widgetManager,                
        ]);

        $html = $this->twigEnv->render($template, $data);
        if($out) {
            $this->resp->setContent($html);
        }
        else 
        {
            return $html;
        }
    }
    
    public function getTwigEnv() : \Twig\Environment
    {
        return $this->twigEnv;
    }
}
