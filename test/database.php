<?php
// database.php
class db{
    private $host;
    private $database;
    private $username;
    private $password;
    private $charset;
    private $db;

function __construct() {
    $this->host ='localhost';
    $this->database ='flowerpower';
    $this->username ='root';
    $this->password ='';
    $this->charset = 'utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, 
        PDO::ATTR_EMULATE_PREPARES => false, 
     ];

    try{
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";

        $this->db = new PDO($dsn, $this->username, $this->password, $options);

    }   catch(\PDOException $e) {
            throw new \PDOException("Error  message is: ". $e->getMessage());
    }
        
}


function insert_admin(){
    
    $sql = "INSERT INTO medewerkers VALUE (:medewerkerscode, :voorletters, :voorvoegsel, :achternaam, :gebruikersnaam, :wachtwoord);";
    // Prepere
    $stmt = $this->db->prepare($sql);
    // execute
    $stmt->execute([
        'medewerkerscode'=>NULL,
        'voorletters' => 'L',
        'voorvoegsel' => '',
        'achternaam' => 'Soelie',
        'gebruikersnaam' => 'lynn',
        'wachtwoord' => password_hash('admin', PASSWORD_DEFAULT)
    ]);
}

function registreer_medewerker($voorletters, $voorvoegsel, $achternaam, $uname, $psw){

    $sql = "INSERT INTO medewerkers VALUE (:medewerkerscode, :voorletters, :voorvoegsel, :achternaam, :gebruikersnaam, :wachtwoord);";

    $stmt = $this->db->prepare($sql);
    
    $stmt->execute([
        'medewerkerscode'=>NULL,
        'voorletters' => $voorletters,
        'voorvoegsel' => $voorvoegsel,
        'achternaam' => $achternaam,
        'gebruikersnaam' => $uname,
        'wachtwoord' => password_hash($psw, PASSWORD_DEFAULT)
    ]);

    header('location: overzicht_medewerker.php');
  
}

function registreer_klant($voorletters, $tussenvoegsel, $achternaam, $adres ,$postcode ,$woonplaats ,$geboortedatum, $uname, $psw){

        $sql = "INSERT INTO klant VALUES (:klantcode, :voorletters, :tussenvoegsel, :achternaam, :adres, :postcode, :woonplaats, :geboortedatum, :gebruikersnaam, :wachtwoord)";

        $stmt = $this->db->prepare($sql);

    
        $stmt->execute([
            'klantcode'=>NULL,
            'voorletters' => $voorletters,
            'tussenvoegsel' => $tussenvoegsel,
            'achternaam' => $achternaam,
            'adres' => $adres,
            'postcode' => $postcode,
            'woonplaats' => $woonplaats,
            'geboortedatum' => $geboortedatum,
            'gebruikersnaam' => $uname,
            'wachtwoord' => password_hash($psw, PASSWORD_DEFAULT)
        ]);

        header('location: loginCustomer.php');
      
}

// bestelling inserten in database
function bestellen($winkelcode, $artikelcode, $aantal, $medewerkerscode){
    // bestellingid, aantal, afgehaald, winkelcode, medewerkerscode, klantcode artikelcode
    $sql = "INSERT INTO bestelling VALUES (:bestellingid, :aantal, :afgehaald, :winkelcode, :medewerkerscode, :klantcode, :artikelcode)";
    print_r($sql);
    $stmt = $this->db->prepare($sql); // checkt syntax van sql string en prepared op server
    print_r($stmt);
    // executes prepared statements, passes values to named placeholders from sql string on line 51
    $stmt->execute([
        'bestellingid'=>NULL,
        'aantal' => $aantal,
        'afgehaald'=>0,
        'winkelcode' => $winkelcode, //fixme: winkelcode
        'artikelcode' => $artikelcode, //fixme: artikelcode
        'medewerkerscode' => $medewerkerscode, //fixme: medewerkerscode
        'klantcode'=>$_SESSION['klantcode']

    ]);
    header('location: klant.php');
  
}


function artikel_toevoegen($artikel, $prijs){

    $sql = "INSERT INTO artikel VALUES (:artikelcode, :artikel, :prijs)";

    $stmt = $this->db->prepare($sql); // checkt syntax van sql string en prepared op server

    // executes prepared statements, passes values to named placeholders from sql string 
    $stmt->execute([
        'artikelcode'=>NULL,
        'artikel' => $artikel,
        'prijs' => $prijs
    ]);
  
}



public function loginmedewerker($uname, $psw){

    $sql = "SELECT medewerkerscode, gebruikersnaam, wachtwoord FROM medewerkers WHERE gebruikersnaam = :gebruikersnaam";

    //prepare
    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        'gebruikersnaam' => $uname
    ]);

    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);

    if(is_array($result)){

        if(count($result) > 0){

            if ($uname == $result['gebruikersnaam'] && password_verify($psw, $result['wachtwoord'])) {

                session_start();
                $_SESSION['medewerkerscode'] = $result['id'];
                $_SESSION['uname'] = $result['gebruikersnaam'];
                $_SESSION['logged_in'] = true;

                header('location: medewerker.php');

            }
        }else{
            echo 'faild to login.';
        }

    }else{
        echo 'Faild to login. please check you input and try again.';
    }

}


public function logincustomer($uname, $psw){

    $sql = "SELECT klantcode, gebruikersnaam, wachtwoord FROM klant WHERE gebruikersnaam = :gebruikersnaam";

    //prepare
    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        'gebruikersnaam' => $uname
    ]);

    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);

    if(is_array($result)){

        if(count($result) > 0){

            if ($uname == $result['gebruikersnaam'] && password_verify($psw, $result['wachtwoord'])) {

                session_start();
                $_SESSION['klantcode'] = $result['klantcode'];
                $_SESSION['uname'] = $result['gebruikersnaam'];
                $_SESSION['logged_in'] = true;
                header('location: klant.php');

            }
        }else{
            echo 'failed to login.';
        }

    }else{
        echo 'Failed to login. please check you input and try again.';
    }

}

public function select($statment, $named_placeholder){

    $stmt = $this->db->prepare($statment);
    $stmt->execute($named_placeholder);
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

public function update_or_delete($statement, $named_placeholder){
        
    $stmt = $this->db->prepare($statement);
    $stmt->execute($named_placeholder);
    header('location:overzicht_artikelen.php');
    header('location:overzicht_medewerker.php');
    header('location:klant.php');
    exit();

}

}