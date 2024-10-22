<?php declare(strict_types = 1);

namespace App\Template;

use App\Menu\MenuReader;
use Knp\Menu\Renderer\ListRenderer;
use App\Utils\Router;
use Aura\Session\Segment;
use Aura\Session\SessionFactory;
use Http\Response;
use Http\Request;
use Twig_Environment;
use App\Utils\Auth;


class FrontendTwigRenderer implements FrontendRenderer
{
	private $renderer;
	private $menuReader;
        private $router;
        private $response;
        private $Twig_Environment;
        private $auth;
        private $request;
        
	public function __construct(Renderer $renderer, MenuReader $menuReader, Router $router, Response $response, Twig_Environment $twig,Auth $auth,
        Request $request)
	{
		$this->renderer = $renderer;
		$this->menuReader = $menuReader;
                $this->router = $router;
                $this->response = $response;
                $this->Twig_Environment = $twig;
                $this->auth = $auth;
                $this->request = $request;
	}

	public function render($template, $data = [],$out = true)
	{       
                $pendingActions = ["actions" => [],"emps" => []];
                $twgMenu = [];
                
                if($out) // It need to return in html then chances are its not a complete page render
                {
                    
                    $matcher = new \Knp\Menu\Matcher\Matcher();    
                    $twgMenu = new \Knp\Menu\Renderer\TwigRenderer($this->Twig_Environment,"knp_menu.html.twig",$matcher);

                    if($this->auth->isLogin() && $this->auth->getUser()->getEmployee()) {
                        $pendingActions = \Modules\System\Processes\WorkflowManager::getNotifications($this->auth->getUser()->getEmployee());                    
                    }                
                
                }
                $session_factory = new SessionFactory;                
                $session = $session_factory->newInstance($_COOKIE)->getSegment(_SESSIONKEY);
                
                $widgetManager = new \Modules\System\Processes\Widgets($this->auth);
                if($this->auth->isLogin()){
                    $systemEvents = new \Modules\System\Processes\FrameworkEvents($this->auth);
                }
                $menu = $this->menuReader->readMenu();
                
                // Render event Hook , remove it when not required !!
                if($this->auth->isLogin()){
                    $this->menuReader->setMenu($systemEvents->perMenuRenderHook($menu));
                }
		$data = array_merge($data, [
			'menuItems' => $this->menuReader->writeMenu($this->router),
                        'renderer' => $twgMenu,
                        'router' => $this->router,
                        'session' => $session,
                        'site_title' => _SITETITLE,
                        'auth' => $this->auth,
                        'config' => $GLOBALS['config'],
                        'request' => $this->request,
                        'thumb' => $this->router->baseUrl('uploads/thumb.php'),
                        'actions' => $pendingActions["actions"],
                        'action_emps' => $pendingActions["emps"],
                        'widgetmgr' => $widgetManager,                        
		]);
                
		$html = $this->renderer->render($template, $data);
                if($out) {
                    $this->response->setContent($html);
                }
                else 
                {
                    return $html;
                }
	}
}
