<?php
require_once 'AlumnoPresencial.php';
require_once 'AlumnoLibre.php';
require_once 'Alumno.php';

if ($_POST['tipo'] == 'libre') {
    $alumno = new AlumnoLibre(
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['dni'],
        $_POST['notaFinal']
    );
} elseif ($_POST['tipo'] == 'presencial') {
    // Invocamos el método static setDiasHabiles, de la clase AlumnoPresencial
    AlumnoPresencial::setDiasHabiles($_POST['diasHabiles']);

    $alumno = new AlumnoPresencial(
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['dni'],
        $_POST['inasistencias'],
        $_POST['notas']
    );
}


//Este archivo responde con un objeto JSON. No hace falta comprenderlo todo
//(aunque estaría bueno). Simplemente entender que el archivo "arma" un array, y
//lo muestra convertido en otro formato (JSON).

$datos['Nombre alumno'] = $alumno->getNombreApellido();
$datos['dni'] = $alumno->getDni();
$datos['nota'] = $alumno->getNota();
$datos['asistencia'] = $alumno->porcentajeAsistencia() . "%";
$datos['condicion'] = $alumno->condicion();

//Para probar el método __toString():
$datos['cadena'] = "Datos del alumno: " . $alumno;


header('Content-Type: application/json');
echo json_encode($datos);
