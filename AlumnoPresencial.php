
<?php
require_once 'Alumno.php';

class AlumnoPresencial extends Alumno

{
    const PORCENTAJE_MIN_ASISTENCIAS = 75;
    private static $diasHabiles = 0;

    protected $inasistencias;
    private $notas;

    public function __construct($nombre, $apellido, $dni, $inasistencias, $notas)
    {
        parent::__construct($nombre, $apellido, $dni);
        $this->inasistencias = $inasistencias;
        $this->notas = $notas;
        self::incrementaContador();
    }

    private static function incrementaContador($n = 1)
    {
        self::$diasHabiles += $n;
    }

    public static function setDiasHabiles($dias)
    {
        self::$diasHabiles = $dias;
    }



    public function getnota()
    {
        if ($this->porcentajeAsistencia() < self::PORCENTAJE_MIN_ASISTENCIAS || $this->noEstaaplazado() == false) {
            return 1;
        } else {
            $suma = 0;
            foreach ($this->notas as $x) {
                $suma = $suma + $x;
            }
            return $suma / count($this->notas);


            // $suma = array_sum($this->notas);
            // $total_numeros = count($this->notas);
            // $notaFinalPresencial = $suma / ($this->total_notas);
            // return $notaFinalPresencial;
            // Da eror de variable no asignada en $total_numeros
        }
    }

    public function porcentajeAsistencia()
    {
        $porcentaje = (((self::$diasHabiles - $this->inasistencias) * 100) / self::$diasHabiles);
        return $porcentaje;
    }

    public function noEstaaplazado()
    {
        foreach ($this->notas as $x) {
            if ($x < 4) {
                return false;
            }
        }
        return true;
    }

    public function condicion()
    {
        if ($this->noEstaaplazado() == false || $this->porcentajeAsistencia() < self::PORCENTAJE_MIN_ASISTENCIAS) {
            return "aplazado";
        } else return "regular";
    }


    public function __toString()
    {
        $string = "Nombre y apellido: $this->nombre $this->apellido, DNI: $this->dni";
        return "$string";
    }
}
