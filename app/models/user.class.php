<?php

Class User extends Controller //pour pouvoir acceder a load_model par le mot cle : this
{
	private $error="";
	public function signup($POST)
	{
		$db= Database::getInstance();
		$data= array(); //on place les info qui vont faire partie de la requette dans un tableau
		$data['name']			=trim($POST['name']); //ici trim elimine les espaces au debut et en fin
		$data['email']			=trim($POST['email']);
		$data['password']		=trim($POST['password']);
		$password2				=trim($POST['password2']); // ne sera pas enregistre sur la base
		//show($data['email']);
		
		if (empty($data['email'])||!preg_match("/^[a-zA-Z\-_]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email']))
		//expression reguliere
		{
			$this->error .= "Entrer un email valide <br>"; // . pour concatenation

		}
		if (empty($data['name'])||!preg_match("/^[a-zA-Z]+$/",$data['name'])) 
		//expression reguliere
		{
			$this->error .= "Entrer un nom valide <br>"; // . pour concatenation

		}

		if ($data['password'] != $password2)
		{
			$this->error .= "Les mots de passe ne correspondent pas <br>"; // . pour concatenation

		}
		if (strlen($data['password'])<4)
		{
			$this->error .= "Le mot de passe doit être d’au moins 4 caractères <br>"; // . pour concatenation

		}

		$sql= "select * from users where email = :email limit 1"; // : veut dire contenu de email
		$arr['email']=$data['email'];
		$check = $db->read($sql,$arr);//db est instancie au debut de la methode
		//retourne les donnees lues, voir read (voir database.php)
		if (is_array($check))
		{
			$this->error .="Cet e-mail est déjà utilisé <br>";
		}

		$data['url_address']=$this->get_random_string_max(60);
		$sql= "select * from users where url_address = :url_address limit 1"; // : veut dire contenu de email
		$arr= false; //permet de vider le tableau
		$arr['url_address']=$data['url_address'];
		$check = $db->read($sql,$arr); //db est instancie au debut de la methode
		//retourne les donnees lues, voir read (voir database.php)

		if (is_array($check))
		{
			$data['url_address']=$this->get_random_string_max(60);
		}


		if ($this->error=="")// si tout va bien : energistrer sur la base de donnees et rediriger vers login 
		{
			$data['role']="customer";
			$data['date']=date("Y-m-d H:i:s");
			$data['password']=hash('sha1',$data['password']); //cryptage pour eviter son apparition sur la base
			//sha1 un type parmie dautres algorithmes de hashage
			
			$query = "insert into users (url_address,name,email,password,date,role) values (:url_address,:name,:email,:password,:date,:role)"; //les deux pints (:) signifient : contenu
			//les champs doivent etre dans le meme ordre 
			
			$result=$db->write($query,$data); //db est instancie au debut de la methode
			if ($result) // $result = true si succes, voir write (voir database.php)
			{

				header("Location:".ROOT."login"); //redirection du navigateur
				//attention ne laisser pas d espace
				die; //ou exit; sort de la methode login
				
			}


		}

		$_SESSION['error']=$this->error; 
		//elle devient une erreur de la session, variable qu on va recuperer et afficher dans signup.php (view)

	}

	public function login($POST)
	{

		//show($_POST);
		$db= Database::getInstance();
		$data= array(); //on place les info qui vont faire partie de la requette dans un  tableau
	
		$data['email']			=trim($POST['email']); //ici trim elimine les espaces au debut et en fin
		$data['password']		=trim($POST['password']);
		
			
		if (empty($data['email'])||!preg_match("/^[a-zA-Z\-_]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email']))
		//expression reguliere
		{
			$this->error .= "Entrer un email valide <br>"; // . pour concatenation

		}
		
		if (strlen($data['password'])<4)
		{
			$this->error .= "Password must be at least 4 characters long<br>"; // . pour concatenation

		}

				
		if ($this->error=="")// rediriger vers home si tout va bien
		{
			
			$data['password']=hash('sha1',$data['password']); //cryptage pour eviter son apparition sur la base
			//sha1 un type parmie dautres algorithmes de hashage
			
			$sql= "select * from users where email = :email && password = :password limit 1"; // : veut dire contenu de email
			$result = $db->read($sql,$data); //db est instancie au debut de la methode
			//retourne les donnees lues, voir read (voir database.php)

			//show(ROOT);
			if (is_array($result))
			{
				
				$_SESSION['user_url']=$result[0]->url_address;//tableau d objets sur la position 0
				header("Location:".ROOT."home"); //redirection du navigateur vers home
				//attention ne laisser pas d espace
				die; //ou exit; sort de la methode login
			}
			
			$this->error .= "Adresse e-mail ou mot de passe incorrect <br>";		

		}

		$_SESSION['error']=$this->error; 
		//elle devient une erreur de la session, variable qu on va recuperer et afficher dans signup.php (view)

	}


	public function get_user($url)
	{
		$db= Database::getInstance();
		$url=esc($url);
		$query="select * from users where url_address = '$url'";
		$result =$db->read($query);
		if ($result) {
			return $result[0];
		}
		return false;
		
	}

	public function get_user_by_id($id)
	{
		$db= Database::getInstance();
		$id=(int)$id;
		$query="select * from users where id = '$id'";
		$result =$db->read($query);
		if ($result) {
			return $result[0];
		}
		return false;
		
	}

	public function get_customers()
	{
		$db= Database::getInstance();
		
		$query="select * from users where role = 'customer'";
		$result =$db->read($query);
		if ($result) {
			return $result;
		}
		return false;
		
	}

	public function get_admins()
	{
		$db= Database::getInstance();
		
		$query="select * from users where role = 'admin'";
		$result =$db->read($query);
		if ($result) {
			return $result;
		}
		return false;
		
	}


	private function get_random_string_max($string)
	//retourne une chaine aleatoire qui sera utilisee pour identifier un utilisateur de maniere unique
    {
        $array=array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $text="";
        $length=60;
        $length=rand(4,$length);
        // rand() retourne un nombre aléatoire entre  min et max,

        for ($i = 0; $i < $length; $i++) 
        {
            $random = rand(0,60);  
            $text .= $array[$random];
        }
      
        return $text;
    }


    public function check_login($redirect=false,$allowed =array())
    {
    	$db= Database::getInstance();
    	
    	if (count($allowed)>0) //ceci empeche tout user non admin d afficher la page admin via l url ..../admin
    	{
    		
	    	$arr['url']=$_SESSION['user_url'];
	    	$query = "select * from users where url_address = :url limit 1"; 
	    	// url est l indice de la donnee dans le tableau et en meme temps la variable url qui contient la donnee
	    	
	    	$result = $db->read($query,$arr);
	    	if (is_array($result))
			{
				$result=$result[0];
				if(in_array($result->role, $allowed)){
					return $result;
				}
			}
			header("Location:".ROOT."login"); //redirection du navigateur
			die;
		} 
    	else 
    	{
	    	if (isset($_SESSION['user_url'])) //en cas de session active retourner les donnes de user
	    	{
		    	$arr=false;
		    	$arr['url']=$_SESSION['user_url'];
		    	$query = "select * from users where url_address = :url limit 1"; 
		    	// url est l indice de la donnee dans le tableau et en meme temps la variable url qui contient la donnee
		    	
		    	$result = $db->read($query,$arr);
		    	if (is_array($result))
				{
					return $result[0];

				}

			}
			if($redirect)
			{

				header("Location:".ROOT."login"); //redirection du navigateur
				die;
			}
		}
		return false;	
    }

    public function logout()
    {
    	//show($_SESSION['user_url']);
    	//die;
    	if (isset($_SESSION['user_url'])) // veut dire : en cas de session active
    	{
    		unset($_SESSION['user_url']);
		}
		
		header("Location:".ROOT."home"); //redirection du navigateur
		//attention ne laisser pas d espace
		die; //ou exit; sort de la methode logout
 
    }

    public function signup_edit($POST,$id,$url_old)
    //lorsque le client change son compte il faut changer aussi l url_address dans la table orders
    //sinon on peut plus acceder a ses commandes lorsqu il modifie son compte
	{
		$id=(int)$id;
		$db= Database::getInstance();
		$data= array(); //on place les info qui vont faire partie de la requette dans un tableau
		$data['name']			=esc(trim($POST['name'])); //ici trim elimine les espaces au debut et en fin
		$data['email']			=esc(trim($POST['email']));
		$data['password']		=esc(trim($POST['password']));
		$password2				=trim($POST['password2']); // ne sera pas enregistre sur la base
		//show($data['email']);
		
		if (empty($data['email'])||!preg_match("/^[a-zA-Z\-_]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email']))
		//expression reguliere
		{
			$this->error .= "Entrer un email valide <br>"; // . pour concatenation

		}
		if (empty($data['name'])||!preg_match("/^[a-zA-Z]+$/",$data['name'])) 
		//expression reguliere
		{
			$this->error .= "Entrer un nom valide <br>"; // . pour concatenation

		}

		if ($data['password'] != $password2)
		{
			$this->error .= "Les mots de passe ne correspondent pas <br>"; // . pour concatenation

		}
		if (strlen($data['password'])<4)
		{
			$this->error .= "Le mot de passe doit être d’au moins 4 caractères <br>"; // . pour concatenation

		}

		
		$data['url_address']=esc($this->get_random_string_max(60));
		$sql= "select * from users where url_address = :url_address limit 1"; // : veut dire contenu de email
		$arr= false; //permet de vider le tableau
		$arr['url_address']=$data['url_address'];
		$check = $db->read($sql,$arr); //db est instancie au debut de la methode
		//retourne les donnees lues, voir read (voir database.php)

		if (is_array($check))
		{
			$data['url_address']=esc($this->get_random_string_max(60));
		}

		if ($this->error=="")// si tout va bien : energistrer sur la base de donnees et rediriger vers login 
		{
			$data['role']=esc("customer");
			$data['date']=esc(date("Y-m-d H:i:s"));
			$data['password']=esc(hash('sha1',$data['password'])); 
			//cryptage pour eviter son apparition sur la base
			//sha1 un type parmie dautres algorithmes de hashage
			
			//dans la methode signup precedent on a utilise $data qu on passe a write
			//ici on doit bien identifier les champs pour passer la requette sans $data
			$name = $data['name'];$email = $data['email'];$password = $data['password'];
			$role = $data['role'];$date = $data['date'];$url_address = $data['url_address'];

			//on a utilise esc pour toutes les informations pour empecher
			//l interpretation des caracteres speciaux qui bloque la requette 
			$query = "update users set url_address='$url_address', name ='$name', email='$email',
			password ='$password', date='$date', role='$role' where id ='$id' limit 1";   
			
			$result=$db->write($query); //db est instancie au debut de la methode
			if ($result) // $result = true si succes, voir write (voir database.php)
			{
				$order = $this->load_model('Order');
				$order->change_url_address($url_address,$url_old); 

				header("Location:".ROOT."login"); //redirection du navigateur
				//attention ne laisser pas d espace
				die; //ou exit; sort de la methode login
				
			}

		}

		$_SESSION['error']=$this->error; 
		//elle devient une erreur de la session, variable qu on va recuperer et afficher dans signup.php (view)

	}

}

?>