<?php

require("conexion.php");

class Tareas extends Conexion{

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();

        $this->fecha = date("y-m-d H:i:s");

    }
    public function nueva_tarea($titulo,$tarea ){

        $sql = "INSERT INTO tareas(Titulo,Fecha,Tarea) VALUES (?,?,?)";
        $insertar = $this->conexion->prepare($sql);
        $array = array($titulo,$this->fecha,$tarea);
        $insertar->execute($array);

        $this->mostrar_tareas();

    }
    public function mostrar_tareas(){
        $sql = "SELECT * FROM tareas";
        $mostrar = $this->conexion->prepare($sql);
        $mostrar->execute();

        $mostrar->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $mostrar->fetch()) {
            echo "<br>"."<h3>".$row['Titulo'] ."</h3>". $row['Fecha'] . "<br><br>" .$row['Tarea'] . "<br><br>";
            echo "<a href='main.php?id=$row[id]&var=3'>Eliminar</a> "." <a href='actualizar.php?id=$row[id]&titulo=$row[Titulo]&tarea=$row[Tarea]&var=4'>Actualizar</a><br>";
        }
    }
    public function actualizar_tarea($id,$titulo,$tarea){
        $sql = "UPDATE tareas SET Titulo=?,Tarea=? WHERE id=$id";
        $actualizar = $this->conexion->prepare($sql);
        $array = array($titulo,$tarea);
        $actualizar->execute($array);

        $this->mostrar_tareas();

    }
    public function eliminar_tarea($id){
        $sql = "DELETE FROM tareas WHERE id=$id";
        $eliminar = $this->conexion->prepare($sql);
        $eliminar->execute();

        $this->mostrar_tareas();
    }
}