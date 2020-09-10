<?php


/**
 * Description of usuarios
 *
 * @author Giovanni
 */
class usuarios {
    private $db;
    public function __construct() {
        try{
            $this->db = new PDO("mysql:dbname=blog;host=localhost","root","");            
        } catch (PDOException $e){
            echo "FALHA: ".$e->getMessage();
        }
    }
    public function selecionar($id){
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $array = array();
        if($sql->rowCount()>0){
            $array = $sql->fetch();
        }
        return $array;
    }
    public function inserir($nome, $email, $senha){
        $query = "INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha";
        $sql = $this->db->prepare($query);
        $sql->bindParam(":nome", $nome);
        $sql->bindParam(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();
    }
    public function atualizar($nome, $email, $senha, $id){
        $query = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
        $sql = $this->db->prepare($query);
        $sql->execute(array($nome,$email, md5($senha),$id));
        
    }
    public function excluir($id){
        $query = "DELETE FROM usuarios WHERE id = ?";
        $sql = $this->db->prepare($query);
        $sql->bindValue(1, $id);
        $sql->execute();
        
    }
}
