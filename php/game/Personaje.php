// Personaje.php

class Personaje {
    public $nombre;
    public $clase;
    public $nivel;
    public $fuerzaBasic;
    public $resistenciaBasic;
    public $destrezaBasic;
    public $magiaBasic;
    public $fuerzaBonif;
    public $resistenciaBonif;
    public $destrezaBonif;
    public $magiaBonif;
    public $statPoint;

    public function __construct($nombre, $clase, $nivel, $fuerzaBasic, $resistenciaBasic, $destrezaBasic, $magiaBasic, $fuerzaBonif, $resistenciaBonif, $destrezaBonif, $magiaBonif, $statPoint) {
        $this->nombre = $nombre;
        $this->clase = $clase;
        $this->nivel = $nivel;
        $this->fuerzaBasic = $fuerzaBasic;
        $this->resistenciaBasic = $resistenciaBasic;
        $this->destrezaBasic = $destrezaBasic;
        $this->magiaBasic = $magiaBasic;
        $this->fuerzaBonif = $fuerzaBonif;
        $this->resistenciaBonif = $resistenciaBonif;
        $this->destrezaBonif = $destrezaBonif;
        $this->magiaBonif = $magiaBonif;
        $this->statPoint = $statPoint;
    }
}
