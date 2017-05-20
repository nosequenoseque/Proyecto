<?php

//require $_SERVER['DOCUMENT_ROOT'].'/ProyectoPruebaTemplate/php/archivosPhp.php';  
//include '../conexionBD.php';


class Usuario {

    private $oid;
    private $nombreUsuario;
    private $password;
    private $nombre;
    private $apellido;
    private $mail;
    private $fechaRegistro;
    private $fotoArchivo;
    private $pais;
    private $activo;
    private $planCuentas;

    function getOid() {
        return $this->oid;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getMail() {
        return $this->mail;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFotoArchivo() {
        return $this->fotoArchivo;
    }

    function getPais() {
        return $this->pais;
    }

    function getActivo() {
        return $this->activo;
    }

    function getPlanCuentas() {
        return $this->planCuentas;
    }

    function setOid($oid) {
        $this->oid = $oid;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFotoArchivo($fotoArchivo) {
        $this->fotoArchivo = $fotoArchivo;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setPlanCuentas($planCuentas) {
        $this->planCuentas = $planCuentas;
    }

    function __construct($nombreUsuario, $password, $nombre, $apellido, $mail) {
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
    }

    public function validar() {
        $retorno = false;
        if ($this->validarNombreUsuario($this->nombreUsuario)) {
            if ($this->nombreApellidoValido($this->nombre)) {
                if ($this->nombreApellidoValido($this->apellido)) {
                    if ($this->mailValido($this->mail)) {
                        if ($this->passwordValida($this->nombre)) {
                            $retorno = true;
                        }
                    }
                }
            }
        }
        return $retorno;
    }

    private function nombreApellidoValido($nomApe) {
        $retorno = false;
        if (empty($nomApe)) {
            $nameErr = "Debe ingresar un nombre y apellido";
        } else {
            $name = test_input($nomApe);
            // chequea si el nombre contiene solo letras y espacios
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Solo se permiten letras y espacios";
            } else {
                $retorno = true;
            }
        }
        return $retorno;
    }

    private function validarNombreUsuario($nombreUsuario) {
        $retorno = false;
        if (empty($nombreUsuario)) {
            $nameErr = "Debe ingresar un nombre y apellido";
        } else {
            $name = test_input($nombreUsuario);
            // chequea si el nombre contiene solo letras y espacios

            if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
                $nameErr = "Solo se permiten letras y espacios";
            } else {
                $retorno = true;
            }
        }

        return $retorno;
    }

    private function mailValido($mail) {
        $retorno = false;

        if (empty($mail)) {
            $emailErr = "Debe ingresar una casilla de mail";
        } else {
            $email = test_input($mail);
            // chequea si el mail tiene formato válido
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Formato de mail inválido";
            } else {
                $retorno = true;
            }
        }

        return $retorno;
    }

    private function passwordValida($pass) {
        $retorno = false;
        if (empty($pass)) {
            $emailErr = "Debe ingresar una contraseña";
        } else {
            $email = test_input($pass);
            // chequea si la clave contiene al menos 8 caracteres, al menos una mayuscula, una minuscula, un dígito y un caracter especial
            if (!preg_match("/^[a-zA-Z ]*$/", $pass)) {
                $emailErr = "Formato de mail inválido";
            } else {
                $retorno = true;
            }
        }

        return $retorno;
    }

    private function convertirFoto($foto) {
        //guardar imagen en carpeta
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);  //filtro contra inyeccion SQL
        return $data;
    }

    public function guardar() {
        $conexionBD = new conexionBD();

        if ($conexionBD->conectar()) {

            $this->nombreUsuario = htmlspecialchars($this->nombreUsuario);
            $this->password = htmlspecialchars($this->password);
            $this->nombre = htmlspecialchars($this->nombre);
            $this->apellido = htmlspecialchars($this->apellido);
            $this->mail = htmlspecialchars($this->mail);


//Pasamos el input del usuario a minúsculas para compararlo después con
//el campo "nombreUsuario" de la base de datos
            $this->nombreUsuario = strtolower($this->nombreUsuario);

//Obtenemos los resultados
            try {
                //////////////inicio TRANSACCION
                $conexionBD->iniciarTransaccion();
                // bloqueamos las tablas para que no se pueda ingresar otros registros
                //antes de que se termina esta transaction
                $conexionBD->exec('LOCK TABLES ultimoOid, usuario');

                //seleccionamos el ultimo oId registrado
                $consulta = $conexionBD->prepare("SELECT oid from ultimoOid where id = 'ultimo'");
                $consulta->execute();
                $resultado = $consulta->fetchAll();
                foreach ($resultado as $row) {
                    $nextId = intval($row[0]);  //obtengo el valor entero del campo 0 de row que es el oid
                }

                //controlar que no se repita el nombre de usuario
                $consulta = $conexionBD->prepare("SELECT nombreUsuario FROM usuario WHERE nombreUsuario ='" . $this->nombreUsuario . "'");
                $consulta->execute();
                $existeUsuario = $consulta->fetchAll();


                foreach ($existeUsuario as $row) {
                    if (count($existeUsuario) == 1) {
                        die(mysql_error());
                    }
                }

                //controlar que no se repita el mail
                $consulta = $conexionBD->prepare("SELECT mail FROM usuario WHERE mail ='" . $this->mail . "'");
                $consulta->execute();
                $existeMail = $consulta->fetchAll();

                foreach ($existeMail as $row) {
                    if (count($existeMail) == 1) {
                        die(mysql_error());
                    }
                }

                //Si el input de usuario o contraseña está vacío, mostramos un mensaje de error
                //Si el valor del input del usuario es igual a alguno que ya exista, mostramos un mensaje de error
                //encriptación de la password
                $this->password = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 15]);

                //Armamos la consulta para introducir los datos
                $consulta = "INSERT INTO usuario (oid, nombreUsuario, password, nombre, apellido, mail, foto, pais, planCuentas) VALUES (:id, :nomUsuario, :pass, :nombre, :apellido, :mail, :foto, :pais, :plan)";
                $resultado = $conexionBD->prepare($consulta);
                $resultado->execute(array(":id" => $nextId, ":nomUsuario" => $this->nombreUsuario, ":pass" => $this->password, ":nombre" => $this->nombre, ":apellido" => $this->apellido, ":mail" => $this->mail, ":pais" => $this->pais, ":plan" => "", ":foto" => $this->fotoArchivo));

                // incrementamos el oID de la tabla ultimooid
                $nextId++;
                $consulta = "UPDATE ultimoOid set oid=" . $nextId . " WHERE id='ultimo'";
                $resultado = $conexionBD->prepare($consulta);
                $resultado->execute();

                $conexionBD->commit();
                $conexionBD->exec('UNLOCK TABLES');
                $conexionBD = null;
                enviarMailVerifiacion();
                die('Se registró correctamente! Te hemos enviado un mail con un link para que actives tu cuenta.');
            } catch (PDOException $e) {
                $conexionBD->rollBack();
                $conexionBD->exec('UNLOCK TABLES');
                $conexionBD = null;
                die('Error al registrarse.');
                //echo "Error: " . $e->getMessage();
            } finally {
                
            }
        } else {
            return false;
        }
    }

    public function verificarCuenta($codigo) {
        //ezequiel
    }

    public function actualizar() {
        //carlos
    }

    public function borrarLogico() {
        //carlos
    }

    public function cargarPorID($idUsuario) {
        //carlos
    }
    public function olvidoPassword() {
        //ezequiel
    }
    public function login($usuario, $pass) {
        //ezequiel
    }

}

