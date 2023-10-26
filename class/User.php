<?php


class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $conn;


    
    public function __construct(
        int $id = null,
        string $nom = "",
        string $prenom = "",
        string $email = "",

    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;

    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function connec(){
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "event-calendar";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function addUser($nom, $prenom, $email, $password){

        $this->connec();

        if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirme_password"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);
            $confirme_password = $_POST["confirme_password"];
            
            if ($_POST["password"] === $_POST["confirme_password"]){
                
                $sql = "INSERT INTO user (nom, prenom, email, password)
                VALUES (:nom, :prenom, :email, :password)";
                
                try {
                    $sth = $this->conn->prepare($sql);
                    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $sth->bindParam(':email', $email, PDO::PARAM_STR);
                    $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
                
                    $sth->execute();
                    echo "Données insérées avec succès.";
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
    }

    public function connecUser($email, $password){

        $this->connec();

        if (isset($_POST["email"]) && $_POST["password"]){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);

            $sql = "SELECT * FROM user WHERE email = :email";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($hash_password === $user["password"]){
                    $_SESSION['username'] = $user['email'];
                    $_SESSION["id"] = $user["id"];
                    //header("location: profil.php");

                }
                else{
                    echo "incorect password";
                }
            }
            else{
                echo "User not found";
            }
        }
    }

    public function profileModif($nom, $prenom, $email, $password){

        $this->connec();

        if (isset($_SESSION['username']) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirme_password"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirme_password = $_POST["confirme_password"];

            if ($_POST["password"] === $_POST["confirme_password"]){

                $hash_password = sha1($_POST["password"]);

                $sql = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password WHERE email = :user_email";

                try {
                    $sth = $this->conn->prepare($sql);
                    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $sth->bindParam(':email', $email, PDO::PARAM_STR);
                    $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
                    $sth->bindParam(':user_email', $_SESSION['username'], PDO::PARAM_STR);

                    $sth->execute();
                    echo "Données insérées avec succès.";
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
    }

    public function getUserInfos($email){

        $this->connec();
        
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($user){
            $this->nom = $user["nom"];
            $this->prenom = $user["prenom"];
            $this->email = $user["email"];
            return $user;

        }
    }

    public function saveEvent($id_user, $date, $titre, $description){
        
        $this->connec();

        $sql = "INSERT INTO event (date, titre, description, id_user) VALUES (?, ?, ?, $id_user)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $date, PDO::PARAM_STR);
        $stmt->bindParam(2, $titre, PDO::PARAM_STR);
        $stmt->bindParam(3, $description, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);        
    }

    public function getAllEvent($id_user){
        $this->connec();
    
        $sql = "SELECT date, titre, description
                FROM event
                WHERE id_user = :id_user";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $events; // Retournez le tableau des événements
    }
    
}