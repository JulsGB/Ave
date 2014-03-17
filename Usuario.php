<?php
error_reporting(E_ALL);

/**
 * emarket - class.Articulo.php
 * (ultima revision $Date: 2013-07-22 )
 *
 * zaca
 * @author Julio Granados  <julio@zaca.org>
 */
if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('./BDUsuario.php');

/**
 * clase Usuario
 * representa todos los usuarios de la aplicacion de ella heredan desarrollador
 * y cliente
 * 
 */
class Usuario {

    //-------------------------------ATTRIBUTOS--------------------------------//
    private $id = null;
    private $password = null;
    private $login = null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {
        $this->login = "";
        $this->password = "";

    }

    //----------GETTERS-------//
    /**
     * @access public
     * @return Integer
     */
    public function getId() {
        $returnValue = $this->id;
        return $returnValue;
    }


    /**
     * @access public
     */
    public function getPassword() {
        $returnValue = $this->password;
        return $returnValue;
    }

    /**
     * @access public
     * @return String
     */
    public function getLogin() {
        $returnValue = $this->login;

        return $returnValue;
    }

    //-------------------SETTERS------------------//
    public function setId($i) {
        $this->id = $i;
    }


    /**
     * @access public
     * @param  String p
     * @return mixed
     */
    public function setPassword($p) {
        $this->password = $p;
    }


    /**
     * @access public
     * @param  String l
     * @return mixed
     */
    public function setLogin($l) {
        $this->login = $l;
    }


    //busqueda de usuario por id
    public function BuscarPorID($i) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        //obtenenemos el resultado
        $result = $objbd->BuscarPorID($i);
        return $result;
    }

    //funcion que devuelve un usuario por su id
    public function DamePorID($id) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        //obtenenemos el resultado
        $result = $objbd->DamePorID($id);
        return $result;
    }

    //funcion que devuelve un usuario por su email
    public function DamePorLogin($email) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        //obtenenemos el resultado
        $result = $objbd->DamePorLogin($email);
        return $result;
    }

    //funcion para autenticar el usuario introducido login y passw
    public function Autenticar($login, $pass) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        $result = $objbd->Autenticar($login, $pass);
        return $result;
    }

    //funcion para saber si un usuario ya esta registrado
    public function Registrado($email) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        $result = $objbd->Registrado($email);
        return $result;
    }


    //funcion para insertar un usuario
    public function Insertar() {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();

        $result = $objbd->Insertar($this->login, $this->password);
        //si se ha insertado correctamente actualizamos el id

        if ($result != false) {
            $this->setId($result);
        }

        return $result;
    }

    //funcion para borrar cualquier usuario devuelve true si se ha conseguido y false si no
    public function delete() {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDUsuario();
        $result = $objbd->delete($this->getId());
        return $result;
    }

    
    public function CuentaTodos($condiciones) {
        $objbd = new BDUsuario();
        $res=$objbd->CuentaTodos($condiciones);
        return $res;
    }
    
    public function DameTodos($condiciones) {
        $objbd = new BDUsuario();
        $res=$objbd->DameTodos($condiciones);
        return $res;
    }
    Public function Consulta($eorigen,$edestino,$corigen,$cdestino,$hsalida){
        $objbd = new BDUsuario();
          $res=$objbd->Consulta($eorigen,$edestino,$corigen,$cdestino,$hsalida);
        return $res;
    }
    
    

}

/* fin de la clase Usuario */
?>