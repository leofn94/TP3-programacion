<?php

require_once 'Alumno.php';

class AlumnoLibre extends Alumno


{
    protected $notaFinal;

    public function __construct($nombre, $apellido, $dni, $notaFinal)
    {
        parent::__construct($nombre, $apellido, $dni);
        $this->notaFinal = $notaFinal;
    }

    public function __toString()
    {
        $string = "Nombre y apellido: $this->nombre $this->apellido, DNI: $this->dni, Nota Final: $this->notaFinal";
        return "$string";
    }
    public function getNota()
    {
        return $this->notaFinal;
    }
}
