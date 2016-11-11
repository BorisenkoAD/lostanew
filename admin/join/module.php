<?php
 class mysql {
	public $db = NULL; // соединение с базой
	private $dsn;
	private $dblogin;
	private $dbpassword;
	
	static function connect($dsn, $dblogin, $dbpassword) {
		$db = new PDO($dsn, $dblogin, $dbpassword, array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SET NAMES 'utf8'");
		$stmt->execute();
		return $db;
	}
} 
class auth {
	
	static $error_arr=array();
	static $error='';
    private $db;
	
    function __construct($param) {
    	$this->db = $param;
    }   
	/**
	 * Это метод проверки пользовательских данных
	 * @param		$login			user login
	 * @param		$passwd			user password one
	 * @param		$passwd2		user password two
	 * @param		$mail			user email
	 * @return		bollean			return true or false
	 */
	function check_new_user($login, $passwd, $passwd2, $mail) {
		//~ validate user data
		if (empty($login) or empty($passwd) or empty($passwd2)) $error[]='All fields are required';
		if ($passwd != $passwd2) $error[]='The passwords do not match';
		if (strlen($login)<3 or strlen($login)>30) $error[]='The login must be between 3 and 30 characters';
		if (strlen($passwd)<3 or strlen($passwd)>30) $error[]='The password must be between 3 and 30 characters';
		//~ validate email
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) $error[]='Not correct email';
		//~ Checks the user with the same name in the database
		$sql = "SELECT COUNT(*) FROM users WHERE login_user='".$login."'";
		if ($res = $this->db->query($sql)) {
			if ($res->fetchColumn() !=0) $error[]='A user with this name already exists'; $sql ='';
		}
		$sql = "SELECT COUNT(*) FROM users WHERE login_user='".$mail."'";
		if ($res = $this->db->query($sql)) {
			if ($res->fetchColumn() !=0) $error[]='User with this email already exists'; $sql ='';		
		}
		//~ return error array or TRUE
		if (isset($error)) {
			self::$error_arr=$error;
			return false;
		} else {
			return true;
		}
	}
	/**
	 *	Этоn метод используется для регистрации нового пользователя
	 *	@return	boolean or string			return true or html code error
	 */	
	function reg() {			
		$tmp_arr=$_POST;
		$login=$tmp_arr['login'];
		$passwd=$tmp_arr['passwd'];
		$passwd2=$tmp_arr['passwd2'];
		$mail=$tmp_arr['mail'];
		//~ User floor translate to a numeric value
		if ($tmp_arr['sex']=='male') {
			$sex='1';
		} else {
			$sex='2';
		}
		//~ Check valid user data
		if ($this->check_new_user($login, $passwd, $passwd2, $mail)) {		
			//~ User data is correct. Register.
			$user_key = $this->generateCode(10);
			$passwd = md5($user_key.$passwd.SECRET_KEY); //~ password hash with the private key and user key
			$res=$this->db->prepare("INSERT INTO users 
													(login_user,
													passwd_user,
													mail_user, 
													sex_user, 
													key_user) 
												VALUES 
													(:login_user,
													:passwd_user,
													:mail_user,
													:sex_user,
													:key_user)"
										);
			$res->bindParam(':login_user', $login);
			$res->bindParam(':passwd_user', $passwd);
			$res->bindParam(':mail_user', $mail);
			$res->bindParam(':sex_user', $sex);
			$res->bindParam(':key_user', $user_key);
			$res->execute();			
			if ($res) {
				return true;
			} else {
				self::$error='An error occurred while registering a new user. Contact the Administration.';
				return false;
			}
		} else {
			return false;		
		}
	}
	
	/**
	 * Этот метод выполняет авторизацию пользователя
	 * @return boolen			true or false
	 */
	function authorization() {
		$user_data=$_POST;		
		$sql="SELECT * FROM users WHERE login_user='".$user_data['login']."'";
		$stmt = $this->db->query($sql);
		$find_user = $stmt->fetch(PDO::FETCH_ASSOC);		
		if (!$find_user) {		
			//~ user not found
			self::$error='User not found';
			return false;
		} else {
			//~ user found
			$passwd=md5($find_user['key_user'].$user_data['passwd'].SECRET_KEY); //~ password hash with the private key and user key
			if ($passwd==$find_user['passwd_user']) {
				//~ passwords match
				$_SESSION['id_user']=$find_user['id_user'];
				$_SESSION['login_user']=$find_user['login_user'];
				//~ if user select "remember me"
				if (isset($user_data['remember']) and $user_data['remember']=='on') {
					$cook_code=$this->generateCode(15);
					$user_agent=$_SERVER['HTTP_USER_AGENT'];
					$res=$this->db->prepare("INSERT INTO session  
														(id_user,
														code_sess, 
														user_agent_sess) 
											VALUES 
														(:id_user,
														:code_sess,
														:user_agent_sess)"
												);
					$res->bindParam(':id_user', $find_user['id_user']);
					$res->bindParam(':code_sess', $cook_code);
					$res->bindParam(':user_agent_sess', $user_agent);
					$res->execute();			
					setcookie("id_user", $_SESSION['id_user'], time()+3600*24*30);
					setcookie("code_user", $cook_code, time()+3600*24*30);
				}
				return true;
			} else {
				//~ passwords not match
				self::$error='User not found or password not match';
				return false;
			}
		}
	}
	/**
	 * Этот метод проверяет, авторизован ли пользователь
	 * @return		boolean				true or false
	 */
	function check() {
		if (isset($_SESSION['id_user']) and isset($_SESSION['login_user'])) {			
			return true;
		} else {
			//~ Verify the existence of cookies
			if (isset($_COOKIE['id_user']) and isset($_COOKIE['code_user'])) {
				//~ cookies exist. Verified with a table sessions.
				$id_user=$_COOKIE['id_user'];
				$code_user=$_COOKIE['code_user'];	
				$sql="SELECT session.*, users.login_user FROM session INNER JOIN users ON users.id_user=session.id_user WHERE session.id_user='".$id_user."'";
				$stmt = $this->db->query($sql);
				$query = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($query and $stmt->fetchColumn() !=0) {					
					//~ Cookies are found in the database
					$user_agent=$_SERVER['HTTP_USER_AGENT'];
					while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {					
						if ($row['code_sess']==$code_user and $row['user_agent_sess']==$user_agent) {
							//~ found record
							$sql="UPDATE session SET used_sess = used_sess +1 WHERE id_sess = '".$row['id_sess']."'";
							$this->db->query($sql);
							//~ start session and update cookie
							$_SESSION['id_user']=$row['id_user'];
							$_SESSION['login_user']=$row['login_user'];
							setcookie("id_user", $row['id_user'], time()+3600*24*30);
							setcookie("code_user", $row['code_sess'], time()+3600*24*30);
							return true;
						}
					}
					//~ No records with this pair of matching cookies/user agent
					$this->destroy_cookie();
					return false;
				} else {
					//~ No records for this user
					$this->destroy_cookie();
					return false;
				}
			} else {
				//~ cookies nit exist
				$this->destroy_cookie();
				return false;
			}
		}
	}
	/**
	 * This method is used for the user exit
	 */
	function exit_user() {
		//~ Destroy session, delete cookie and redirect to main page
		session_destroy();
		setcookie("id_user", '', time()-3600);
		setcookie("code_user", '', time()-3600);
		header("Location: signin.php");
	}

	/**
	 * This method destroy cookie
	 */
	function destroy_cookie() {
		setcookie("id_user", '', time()-3600);
		setcookie("code_user", '', time()-3600);
	}
	
	function generateCode($length) { 
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
		$code = ""; 
		$clen = strlen($chars) - 1;   
		while (strlen($code) < $length) { 
			$code .= $chars[mt_rand(0,$clen)];   
		} 
		return $code; 
	}

	function error_reporting() {
		$r='';
		if (mb_strlen(self::$error)>0) {
			$r.=self::$error;
		}
		if (count(self::$error_arr)>0) {
			$r.='<h2>The following errors occurred:</h2>'."\n".'<ul>';
			foreach(self::$error_arr as $key=>$value) {
				$r.='<li>'.$value.'</li>';
			}
			$r.='</ul>';
		}
		return $r;
	}
}
	// aplication form - анкета-заявление на вакансию
class appForm { 
	
	static $error_arr=array();
	static $error='';
	
 	 protected $position;
	 protected $schedule;
	 protected $date_get_start;
	 protected $salary_desired;
	 protected $name;
	 protected $lastname;
	 protected $dlastname;
	 protected $email;
	 protected $tel;
	 protected $citizenship;
	 protected $place_liv;
	 protected $birthday;
	 protected $company_name;
	 protected $post;
	 protected $age;
	 protected $start_job;
	 protected $end_job;
	 protected $responsibilities;
	 protected $skills;
	 protected $institute;
	 protected $speciality;
	 protected $diplom;
	 protected $grad_year;
	 protected $id;
	 protected $date;
	
 	function __construct ($position=null, $schedule=null, $date_get_start=null, $salary_desired=null, $name=null, $lastname=null, $dlastname=null, $email=null, $tel=null, $citizenship=null, $place_liv=null, $birthday=null, $company_name=null, $post=null, $start_job=null, $end_job=null, $responsibilities=null, $skills=null, $institute=null, $speciality=null, $diplom=null, $grad_year=null) {
		
  		if ($position!==null) 			$this->position = $position;
		if ($schedule!==null) 			$this->schedule = $schedule;
		if ($date_get_start!==null) 	$this->date_get_start = $date_get_start;
		if ($salary_desired!==null) 	$this->salary_desired = $salary_desired;
		if ($name!==null) 				$this->name = $name;
		if ($lastname!==null) 			$this->lastname = $lastname;
		if ($dlastname!==null) 			$this->dlastname = $dlastname;
		if ($email!==null) 				$this->email = $email;
		if ($tel!==null) 				$this->tel = $tel;
		if ($citizenship!==null) 		$this->citizenship = $citizenship;
		if ($place_liv!==null) 			$this->place_liv = $place_liv;
		if ($birthday!==null) 			$this->birthday = $birthday;
		if ($company_name!==null) 		$this->company_name = $company_name;
		if ($post!==null) 				$this->post = $post;
		if ($start_job!==null) 			$this->start_job = $start_job;
		if ($end_job!==null) 			$this->end_job = $end_job;
		if ($responsibilities!==null) 	$this->responsibilities = $responsibilities;
		if ($skills!==null) 			$this->skills = $skills;
		if ($institute!==null) 			$this->institute = $institute;
		if ($speciality!==null) 		$this->speciality = $speciality;
		if ($diplom!==null) 			$this->diplom = $diplom;
		if ($grad_year!==null) 			$this->grad_year = $grad_year;  		
		
	}
	
	function getPosition() {
		return $this->position;
	}
	function getSchedule() {
		return $this->schedule;
	}
	function getDate_get_start() {
		return $this->date_get_start;
	}
	function getSalary_desired() {
		return $this->salary_desired;
	}
	function getDLastName() {
		return $this->dlastname;
	}
	function getBirthday() {
		return $this->birthday;
	}	
	function getCitizenship() {
		return $this->citizenship;
	}
	function getPlace_liv() {
		return $this->place_liv;
	}
	function getAge() {
		return $this->age;
	}	
	function getCompany_name() {
		return $this->company_name;
	}	
	function getPost() {
		return $this->post;
	}	
	function getStart_job() {
		return $this->start_job;
	}	
	function getEnd_job() {
		return $this->end_job;
	}	
	function getInstitute() {
		return $this->institute;
	}	
	function getSpeciality() {
		return $this->speciality;
	}	
	function getDiplom() {
		return $this->diplom;
	}	
	function getGrad_year() {
		return $this->grad_year;
	}	
	function getName() {
		return $this->name;
	}
	function getLastName() {
		return $this->lastname;
	}
	function getTel() {
		return $this->tel;
	}
	function getEmail() {
		return $this->email;
	}
	function getResponsibilities() {
		return $this->responsibilities;
	}
	function getSkills() {
		return $this->skills;
	}	
	function getId() {
		return $this->id;
	}
	function getDate() {
		return $this->date;
	}	
}

class appFormAction {
	
	static $error_arr=array();
	static $error='';
	
	private $db;
		
    function __construct($param) {
    	$this->db = $param;
    }
	
	/*appFormPrint метод вывода на печать анкеты
	*@param		$id			требуемая запись
	* @return		bollean			return true or false	
	*/
	function appFormPrint ($id) {
		
	}
	/*appFormSend метод отправки на почту анкеты
	*@param		$id			требуемая запись
	* @return		bollean			return true or false
	*/
	function appFormSend ($id) {
		
	}
	/*appFormDelete метод удаления анкеты
	*@param		$id			требуемая запись
	 * @return		bollean			return true or false	
	*/
	function appFormDelete ($id) {
		$sql = "UPDATE anketa SET deleted = 1 WHERE id = ?";	
		$handle = $this->db->prepare($sql);		
		$handle->bindParam(1, $id, PDO::PARAM_INT);		
		if ($handle->execute()) 
			{
			header("Location: index.php");
			return true;
			} else {
			return false;
			}		
	}
	
	function appFormGet () {
		$sql="SELECT position, schedule, date_get_start, salary_desired, name, lastname, dlastname, email, tel, citizenship, place_liv, birthday, age, company_name, post, start_job, end_job, responsibilities, skills, institute, speciality, diplom, grad_year, id FROM anketa WHERE deleted = 0 order by id desc";
		$data = $this->db->query($sql);
		$data->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'appForm');
		$obj = $data->fetchall();
		return $obj;
	}
	
	 /* appFormAdd - Метод добавления анкеты с формы на сайте
	 * @param		$Position			Наименование вакансии
	 * @param		$Schedule			График работы    
	 * @param		$Date_get_start		Дата начала работы
	 * @param		$Salary_desired		Желаемая зп
	 * @param		$Name				Имя       	 
	 * @param		$LastName			Фамилия   
	 * @param		$DLastName			Отчество  	 
	 * @param		$Tel				Телефон
	 * @param		$Email				Почта      
	 * @param		$age				Возраст	 
	 * @param		$Citizenship		Гражданство      
	 * @param		$Place_liv			Место проживания 
	 * @param		$Company_name		Предыдущее место работы
	 * @param		$Post				
	 * @param		$Start_job			Начало работы на пред месте
	 * @param		$End_job			Окончание работы на пред месте
	 * @param		$responsibilities	Обязанности   
	 * @param		$skills				Навыки    	 
	 * @param		$Institute			Институт  
	 * @param		$Speciality			Специальность
	 * @param		$Diplom				Уровень          
	 * @param		$Grad_year			Дата окончания обучения
	 * @param		$date				Дата заполнения анкеты   
		 
	 * @return		bollean			return true or false
	 */	
	function appFormAdd ($appForm) {
				
		$position = 		$appForm->getPosition(); 
		$schedule = 		$appForm->getSchedule(); 
		$date_get_start = 	$appForm->getDate_get_start(); 
		$salary_desired = 	$appForm->getSalary_desired(); 
		$dlastname = 		$appForm->getDLastName(); 
		$citizenship = 		$appForm->getCitizenship();			
 		$place_liv = 		$appForm->getPlace_liv();		
		$company_name = 	$appForm->getCompany_name();		
		$post = 			$appForm->getPost(); 		
		$start_job = 		$appForm->getStart_job();		
		$end_job = 			$appForm->getEnd_job(); 		
		$institute = 		$appForm->getInstitute(); 		
		$speciality = 		$appForm->getSpeciality(); 		
		$diplom = 			$appForm->getDiplom(); 		
		$grad_year = 		$appForm->getGrad_year(); 		
		$name = 			$appForm->getName();	
		$lastname = 		$appForm->getLastName();
		$tel = 				$appForm->getTel(); 
		$email = 			$appForm->getEmail();
		$birthday =			$appForm->getBirthday();
		$responsibilities = $appForm->getResponsibilities(); 
		$skills = 			$appForm->getSkills(); 	

		$sql = "INSERT INTO anketa (position, schedule, date_get_start, salary_desired, name, lastname, dlastname, email, tel, citizenship, place_liv, birthday, age, company_name, post, start_job, end_job, responsibilities, skills, institute, speciality, diplom, grad_year) VALUES (:position, :schedule, :date_get_start, :salary_desired, :name,:lastname, :dlastname, :email, :tel, :citizenship,:place_liv,:birthday, (SELECT TIMESTAMPDIFF(YEAR, :birthday, CURDATE())), :company_name, :post, :start_job, :end_job, :responsibilities, :skills, :institute, :speciality, :diplom, :grad_year)";
		
		$handle = $this->db->prepare($sql);
		
		$handle->bindParam(':position', $position);
		$handle->bindParam(':schedule', $schedule);
		$handle->bindParam(':date_get_start', $date_get_start);
		$handle->bindParam(':salary_desired', $salary_desired);
		$handle->bindParam(':name', $name);
		$handle->bindParam(':lastname', $lastname);
		$handle->bindParam(':dlastname', $dlastname);
		$handle->bindParam(':email', $email);
		$handle->bindParam(':tel', $tel);
		$handle->bindParam(':citizenship', $citizenship);
		$handle->bindParam(':place_liv', $place_liv);
		$handle->bindParam(':birthday', $birthday);
		$handle->bindParam(':company_name', $company_name);
		$handle->bindParam(':post', $post);
		$handle->bindParam(':start_job', $start_job);
		$handle->bindParam(':end_job', $end_job);
		$handle->bindParam(':responsibilities', $responsibilities);
		$handle->bindParam(':skills', $skills);	
		$handle->bindParam(':institute', $institute);
		$handle->bindParam(':speciality', $speciality);
		$handle->bindParam(':diplom', $diplom);
		$handle->bindParam(':grad_year', $grad_year);
		
		if ($handle->execute()) 
		{
			return true;
		} else {
			return false;
			}
	
	}	
	
	
}

class vacancyAction {
		
	static $error_arr=array();
	static $error='';
    private $db;
	
    function __construct($param) {
    	$this->db = $param;
    }
		
	function vacancyAdd ($vacancy) {

	$this->exp=$exp;
	$this->edu=$edu;
	$this->salary=$salary;			
	$this->cond=$cond;
	$this->name=$name;
	$this->desc=$desc;
	$this->requir=$requir;		
	$this->dept=$dept;
	$this->deptUser=$deptUser;
	$this->contacts=$contacts;
	$login_user = $_SESSION['login_user'];
	
	
	$sql="INSERT into vacancy (experience, education, salary, conditions, name, description, requirements, login_user)";
	$handle = $this->db->prepare($sql);
		
		$handle->bindParam(':experience', $position);
		$handle->bindParam(':education', $schedule);
		$handle->bindParam(':salary', $date_get_start);
		$handle->bindParam(':conditions', $salary_desired);
		$handle->bindParam(':name', $name);
		$handle->bindParam(':description', $description);
		$handle->bindParam(':requirements', $dlastname);	
	}
	
	function vacancyDelete ($vacancy) {

		$name = vacancy::getName();
		$desc = vacancy::getDesc();
		$requir = vacancy::getRequir();	
		// передача данных в процедуру
	}	
	
	function vacancyEdit ($vacancy) {}
}

class vacancy {
		
	static $error_arr=array();
	static $error='';
	
	protected $exp;		// опыт работы
	protected $edu;		// образование
	protected $salary;	// ЗП
	protected $cond;	// условия
	protected $name;	// наименование вакансии
	protected $desc;	// обязанности вакансии 
	protected $requir;	// требования вакансии
	protected $deptUser;// сотрудник ОП - по сотруднику узнаем какой отдел, контакты и прочую служебную инфу
		
	function __construct ($exp=null, $edu=null, $salary=null, $cond=null, $name=null, $desc=null, $requir=null, $deptUser=null) {
		
		if ($exp!==null) 			$this->exp=$exp;
		if ($edu!==null) 			$this->edu=$edu;
		if ($salary!==null) 		$this->salary=$salary;			
		if ($cond!==null) 			$this->cond=$cond;
		if ($name!==null) 			$this->name=$name;
		if ($desc!==null) 			$this->desc=$desc;
		if ($requir!==null) 		$this->requir=$requir;		
		if ($deptUser!==null) 		$this->deptUser=$deptUser;

	}
	
	function getExp() {
		return $this->exp;
	}	
	function getEdu() {
		return $this->edu;
	}
	function getCond() {
		return $this->cond;
	}	
	function getSalary() {
		return $this->salary;
	}			
	function getName() {
		return $this->name;
	}
	function getDesc() {
		return $this->desc;
	}
	function getResp() {
		return $this->resp;
	}
	function getDept() {
		return $this->dept;
	}
	function getDeptUser() {
		return $this->deptUser;
	}
	function getContacts() {
		return $this->contacts;
	}
	
}

class profile {}
?>
