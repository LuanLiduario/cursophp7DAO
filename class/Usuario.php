<?php
class Usuario{
    /**
     * @var
     */
    private $id;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id=$id;
    }

    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * @param mixed $deslogin
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }

    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * @param mixed $dessenha
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }

    /**
     * @return mixed
     */
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * @param mixed $dtcadastro
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;
    }

    /**
     * @param $id
     */
    public function loadById($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tab_usuarios WHERE id = :ID",array(":ID"=>$id));
        if(count($results)>0){
            $this->setData($results[0]);
        }
    }

    /**
     * @return array
     */
    public static function getList()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tab_usuarios ORDER BY deslogin");
    }

    /**
     * @param $login
     * @return array
     */
    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tab_usuarios WHERE deslogin LIKE  :SEARCH ORDER  BY deslogin",array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    /**
     * @param $login
     * @param $password
     * @throws Exception
     */
    public function login($login,$password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tab_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));
        if(count($results)>0){
            $this->setData($results[0]);
        } else {
            throw new Exception("LOGIN OU/E SENHA INVALIDO");
        }
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function setData($data)
    {
        $this->setId($data['id']);
        $this->setDessenha($data['dessenha']);
        $this->setDeslogin($data['deslogin']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    /**
     * Usuario constructor.
     * @param string $login
     * @param string $password
     */
    public function __construct($login = "" ,$password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    /**
     * @throws Exception
     */
    public function insert()
    {
        $sql = new Sql;
        $results = $sql->select("CALL sp_usuario_insert (:LOGIN,:PASSWORD)",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));
        //var_dump($results);
        if(count($results)>0){
            $this->setData($results[0]);
        }
    }

    public function update()
    {
        $sql = new Sql();
        $sql->query("")
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return json_encode(array(
            "id"=>$this->getId(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}
?>