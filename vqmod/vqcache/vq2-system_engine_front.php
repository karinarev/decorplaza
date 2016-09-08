<?php
final class Front {
	protected $registry;
	protected $pre_action = array();
	protected $error;
	
	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function addPreAction($pre_action) {
		$this->pre_action[] = $pre_action;
	}
	
  	public function dispatch($action, $error) {
// SOFORP Redirect Manager - begin
                    if (!defined('HTTP_CATALOG') && $this->registry->get("config")->get('soforp_redirect_manager_status') == 1 ) {
                        $this->registry->get("load")->model('tool/soforp_redirect_manager');
                        $this->registry->get("model_tool_soforp_redirect_manager")->checkUrl();
                    }
                    // SOFORP Redirect Manager - end
		$this->error = $error;
			
		foreach ($this->pre_action as $pre_action) {
			$result = $this->execute($pre_action);
					
			if ($result) {
				$action = $result;
				
				break;
			}
		}
			
		while ($action) {
			$action = $this->execute($action);
		}
  	}
    
	private function execute($action) {
		if (file_exists($action->getFile())) {
			require_once(VQMod::modCheck($action->getFile()));
			
			$class = $action->getClass();

			$controller = new $class($this->registry);
			
			if (is_callable(array($controller, $action->getMethod()))) {
				$action = call_user_func_array(array($controller, $action->getMethod()), $action->getArgs());
			} else {
				$action = $this->error;
			
				$this->error = '';
			}
		} else {
			$action = $this->error;
			
			$this->error = '';
		}
		
		return $action;
	}
}
?>
