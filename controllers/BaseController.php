<?php

abstract class BaseController {
    protected $controllerName;
    protected $actionName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isLoggedIn = false;

    function __construct($controllerName, $actionName) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->onInit();
        
        if (isset($_SESSION['user'])) {
            $this->isLoggedIn = true;
        }
    }

    public function onInit() {
        // Implement initializing logic in the subclasses
    }

    public function index() {
        // Implement the default action in the subclasses
    }

    public function renderView($viewName = null, $includeLayout = true) {
        if (!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->actionName;
            }
            
            $viewFileName = "views/$this->controllerName/$viewName.php";
            if ($includeLayout) {
                $headerFile = "views/layouts/$this->layoutName/header.php";
                include_once($headerFile);
            }
            
            include_once($viewFileName);
            if ($includeLayout) {
                $footerFile = "views/layouts/$this->layoutName/footer.php";
                include_once($footerFile);
            }
            
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect($controllerName, $actionName = null, $params = null) {
        $url = BASE_HOST . '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        
        $this->redirectToUrl($url);
    }
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        
        array_push($_SESSION['messages'], array('text' => $msg, 'type' => $type));
    }
    
    function authorize($msg) {
        if (!$this->isLoggedIn) {
            $this->addErrorMessage($msg);
            $this->redirect('account', 'login');
        }
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }
}
