<?php

class conexionBD {

    private $conexion;
    private $nombreServer = 'localhost';
    private $usuario = 'root';
    private $pass = '';

    public function conectar() {

        try {
            $this->conexion = new PDO('mysql:host=' . $this->nombreServer . ';dbname=yedPrueba', $this->usuario, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //die ("Conectado Correctamente");
            return $this->conexion;
        } catch (Exception $ex) {
            die('Fallo  en la conexion: ' . $ex->getMessage());
        }
    }

    public function iniciarTransaccion(){
        $this->conexion->beginTransaction();
    }

    public function selectUsuarios(){
        $res = null;
        $conexionBD = new conexionBD();
        $conexion = $conexionBD->conectar();

        $sql = 'select * from usuarios';
        $consulta = $conexion->prepare($sql);
        $consulta->execute();

        while ($resultado = $consulta->fetch()) {
            $res[] = $resultado;
        }
        $conexion = null;

        die(var_dump($res));
    }
}
