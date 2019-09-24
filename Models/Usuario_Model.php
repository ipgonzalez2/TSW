<?php
    //clase Usuario
    class Usuario_Model{
        //variables
        var $email;
        var $nombre;
        var $contraseña;
        //conexion con la base de datos
        var $mysqli;

        //constructor
        function __construct($email=null, $nombre=null, $contraseña=null){


            $this->email=$email;
            $this->nombre=$nombre;
            $this->contraseña=$contraseña;

            include_once '../Models/Access_DB.php';
	        $this->mysqli = ConnectDB();

        }

        function getEmail(){
            return $this->email;
        }
        function getNombre(){
            return $this->nombre;
        }
        function getContraseña(){
            return $this->contraseña;
        }

        function login(){

            $sql = "SELECT *
                    FROM USUARIO
                    WHERE (
                        (login = '$this->login') 
                    )";
                   

            if(!isset($this->login)){
                return 'Login vacio';
            }
        
            $resultado = $this->mysqli->query($sql);
            if ($resultado->num_rows == 0){
                return 'El login no existe';
            }
            else{
                
                $tupla = $resultado->fetch_array();
                if ($tupla['PASSWORD'] == $this->contraseña){
                       return 'true';
                }
                else{
                    return 'La contraseña para este usuario no es correcta';
                }
            }
        }//fin metodo login

        //Función que comprueba si un usuario es válido para ser insertado
        function comprobarValidez(){
            //Comprueba que se haya introduc¡do un email, un dni o un login
            if(!isset($this->email) || !isset($this->contraseña)){
                return "Algunos datos estan vacíos";
            }

            //Comprueba si el usuario ya está insertado en la base de datos
            $sql = "SELECT *
                    FROM USUARIO 
                    WHERE  `email` = '$this->email'";

            $resultado = $this->mysqli->query($sql);
            //Si ya existia un usuario en la base de datos con esos datos devuelve un mensaje de error
            if($resultado->num_rows == 1){
                return 'Usuario ya existente';
            }
            else{
                return 'true';
            }
        }

        //Funcion que sirve para insertar el usuario en la base de datos
        function register(){
            
            //Se inserta el usuario en la base de datos y se guarda el resultado en la variable sql
            $sql = "INSERT INTO USUARIO VALUES('$this->email', '$this->nombre', '$this->contraseña')";
            //Se comprueba si se ha insertado correctamente el usuario y devuelve un mensaje con el resultado
            if($this->mysqli->query($sql)){
                return 'Registrado';
            }
            else{
                return 'Error de inserción';
            }
        }

        //Función que borra un usuario de la base de datos, borrando el directorio en el que se guardaba su avatar
        function delete(){

            $sql = "DELETE FROM USUARIO
                    WHERE `EMAIL` = '$this->email'";

            if($this->mysqli->query($sql)){
                return 'Usuario eliminado';
            }
            else{
                return 'Error eliminando';
            }
        }

        //Función que busca un usuario dado su email
        function findByEmail(){
            //Busca al usuario por su email y guarda el resultado en la variable sql
            $sql = "SELECT * 
                    FROM USUARIO
                    WHERE `EMAIL` = '$this->email'";

            $resultado = $this->mysqli->query($sql);
            //Si la búsqueda del usuario no devuelve ningún resultado, se devuelve un mensaje de email incorrecto
            if($resultado->num_rows == 0){
                return 'Email incorrecto';
            }
            else{
                //Guarda cada uno de los atributos del usuario de la búsqueda y devuelve el usuario
                $tupla = $resultado->fetch_array();
                $this->email = $tupla['EMAIL'];
                $this->nombre = $tupla['NOMBRE'];
                $this->contraseña = $tupla['PASSWORD'];
                return $this;
            }
        }


    } 
?>