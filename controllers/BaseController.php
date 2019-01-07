<?php

abstract class BaseController {
	public $templatesPath = BASE_HOST . '/content/images/templates';
	public $memesPath = BASE_HOST . '/content/images/memes';

	protected static $db;
	protected $controllerName;
	protected $actionName;
	protected $layoutName = DEFAULT_LAYOUT;
	protected $isViewRendered = false;
	protected $isLoggedIn = false;

	function __construct($controllerName, $actionName) {
		if (self::$db == null) {
			// host, user, password, dbname
			self::$db = new mysqli('localhost', 'root', '', 'memes');
			if (self::$db->connect_errno) {
				die('Cannot connect to database');
			}

			self::$db->set_charset("utf8");
		}

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
			
			if ($includeLayout) {
				$headerFile = "views/layouts/$this->layoutName/header.php";
				include_once($headerFile);
			}
			
			include_once("views/$this->controllerName/$viewName.php");
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
			$encodedParams = array_map(function($element) { return urlencode($element); }, $params);
			$url = $url . '/' . implode('/', $encodedParams);
		}
		
		$this->redirectToUrl($url);
	}
	
	protected function isPost() {
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	function addMessage($msg, $type = 'info') {
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

	function isLoggedIn() {
		return $this->isLoggedIn;
	}

	function addInfoMessage($msg) {
		$this->addMessage($msg, 'info');
	}

	function addSuccessMessage($msg) {
		$this->addMessage($msg, 'success');
	}

	function addErrorMessage($msg) {
		$this->addMessage($msg, 'error');
	}

	protected function dbLogin($username, $password) {
		$statement = self::$db->prepare("SELECT username, pass_hash FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		
		if (password_verify($password, $result['pass_hash'])) {
			return true;
		}
		
		return false;
	}

	protected function dbGetID($username){
		$statement = self::$db->prepare("SELECT id FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();

		return $result;
	}
	
	protected function dbRegister($username, $password, $email) {
		if (!isset($username) || strlen($username) < 3 || strlen($email) < 5) {
			return "Потребителското трябва да съдържа поне 3 символа и email-a 6 символа!";
		}
	
		$statement = self::$db->prepare("SELECT COUNT(id) AS 'count' FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();

		if ($result['count']) {
			return "Потребителското име е заето!";
		}
		
		$pass_hash = password_hash($password, PASSWORD_BCRYPT);
		
		$registerStatement = self::$db->prepare("INSERT INTO Users (username, pass_hash, email) VALUES (?, ?, ?)");
		$registerStatement->bind_param("sss", $username, $pass_hash, $email);
		$registerStatement->execute();
		
		return "";
	}

	protected function dbGetAllMemes() {
		$statement = self::$db->query(
			"select m.id as meme_id, m.file_name, m.title, m.created_at, u.id as user_id, u.username 
			from memes m 
			join users u on m.user_id = u.id
			order by m.id desc"
		);
		return $statement->fetch_all(MYSQLI_ASSOC);
	}

	protected function dbGetMemesByUser($userId) {
		$statement = self::$db->prepare(
			"select m.id as meme_id, m.file_name, m.title, m.created_at, u.id as user_id, u.username 
			from memes m 
			join users u on m.user_id = u.id 
			where user_id = ?"
		);
		$statement->bind_param("i", $userId);
		$statement->execute();
		$result = $statement->get_result();

		return $result->fetch_all(MYSQLI_ASSOC);
	}

	protected function dbFindMeme($id) {
		$statement = self::$db->prepare(
			"select m.id as meme_id, m.file_name, m.title, m.created_at, u.id as user_id, u.username 
			from memes m 
			join users u on m.user_id = u.id 
			where m.id = ?"
		);
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->get_result()->fetch_assoc();
	}

	protected function dbCreateMeme($title, $filename) {
		$statement = self::$db->prepare("INSERT INTO memes (title, file_name, user_id) VALUES (?, ?, ?)");
		
		$userID = $_SESSION['userID'];
		$statement->bind_param("ssi", $title, $filename, $userID);

		$statement->execute();
		return $statement->affected_rows > 0;
	}

	protected function dbDeleteMeme($id) {
		$statement = self::$db->prepare("DELETE from memes where id = ?");
		$statement->bind_param("i", $id);

		$statement->execute();
		return $statement->affected_rows > 0;
	}

	protected function dbGetAllUsers() {
		$statement = self::$db->query("SELECT id, username FROM users");
		return $statement->fetch_all(MYSQLI_ASSOC);
	}
	
	protected function dbFindUser($id) {
		$statement = self::$db->prepare("SELECT * FROM users WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		return $statement->get_result()->fetch_assoc();
	}

	protected function dbGetAllComments($memeID){
		$statement = self::$db->prepare("SELECT * FROM v_comments WHERE meme_id = ? ORDER BY id DESC");
		$statement->bind_param("i", $memeID);
		$statement->execute();

		return $statement->get_result()->fetch_all();
	}

	protected function dbCreateComment($commentText, $memeID) {
		if ($commentText == '') {
			return false;
		}
		$statement = self::$db->prepare(
			"INSERT INTO comments (comment, meme_id, user_id) VALUES (?, ?, ?)"
		);
		
		$userID = $_SESSION['userID'];
		$statement->bind_param("sii", $commentText, $memeID, $userID);

		$statement->execute();
		return $statement->affected_rows > 0;
	}

	protected function dbGetAllTemplates() {
		$statement = self::$db->query("SELECT id, name, file_name, positions FROM templates");
		return $statement->fetch_all(MYSQLI_ASSOC);
	}

	protected function dbGetLastTemplateID() {
		$rowSQL = self::$db->query("SELECT max(id) AS max FROM templates");
		$row = mysqli_fetch_array( $rowSQL );

		return $row['max'];
	}

	protected function dbAddTemplate($memeName, $memeFileName, $positions) {
		$statement = self::$db->prepare(
			"INSERT INTO templates (name, file_name, positions) VALUES (?, ?, ?)"
		);
		
		$userID = $_SESSION['userID'];
		if (empty($memeName)) {
			$memeName = "Без наименование";
		}
		$statement->bind_param("sss", $memeName, $memeFileName, $positions);

		$statement->execute();
		return $statement->affected_rows > 0;
	}
}
