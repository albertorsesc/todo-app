<?php

require("crud.php");
session_start();

$session = $_SESSION['session'];

if ($session == null || $session = ''){
    echo 'Debe iniciar sesion para mostrar esta pagina.';
    die();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Todo_app</title>
</head>
<body>
<h1>Bienvenido: <?php echo $_SESSION['session'] ?></h1>

<a href="main.php?var=1">Nueva tarea.</a>
<a href="main.php?var=2">Mostrar tareas.</a>

<?php

    $obj_crud = new Tareas();

    if (!empty($_GET["var"])) {
        $var=$_GET["var"];
        switch ($var) {

            case 1:
                if (empty($_POST["titulo"]) && empty($_POST["tarea"])){
                    header("Location:crear_tarea.php");
                }else {
                    $titulo = $_POST["titulo"];
                    $tarea = $_POST["tarea"];

                    $obj_crud->nueva_tarea($titulo, $tarea);
                }
                break;
            case 2:
                $obj_crud->mostrar_tareas();
                break;
            case 3:
                if (!empty($_GET["id"])) {

                    $id = $_GET["id"];
                    $obj_crud->eliminar_tarea($id);
                }
                break;
            case 4:
                if (!empty($_POST["id"])) {
                    $id = $_POST["id"];
                    $titulo = $_POST["titulo"];
                    $tarea = $_POST["tarea"];
                    $obj_crud->actualizar_tarea($id, $titulo, $tarea);
                }
                break;
        }
    }

?>
<br>
<br>
<a href="cerrar_sesion.php">Cerrar sesion.</a>
</body>
</html>

