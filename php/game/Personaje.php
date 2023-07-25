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

    public $HP_Max;
    public $MP_Max;
    public $Atk_Fisico;
    public $Atk_Magico;
    public $Defensa_fisica;
    public $Defensa_Magica;
    public $Hit_rate;
    public $atk_speed;
    public $Crit_chance;

    public $HP_actual;
    public $MP_actual;

    public function __construct($nombre, $clase, $nivel, $fuerzaBasic, $resistenciaBasic, $destrezaBasic, $magiaBasic, $fuerzaBonif, $resistenciaBonif, $destrezaBonif, $magiaBonif, $statPoint, $HP_actual, $MP_actual) {
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

        // Calculate and initialize the properties related to calculations
        $this->HP_Max = $this->calculateHPMax();
        $this->MP_Max = $this->calculateMPMax();
        $this->Atk_Fisico = $this->calculateAtkFisico();
        $this->Atk_Magico = $this->calculateAtkMagico();
        $this->Defensa_fisica = $this->calculateDefensaFisica();
        $this->Defensa_Magica = $this->calculateDefensaMagica();
        $this->Hit_rate = $this->calculateHitRate();
        $this->atk_speed = $this->calculateAtkSpeed();
        $this->Crit_chance = $this->calculateCritChance();

        // Initialize HP_actual and MP_actual with the values from HP_Max and MP_Max
        $this->HP_actual = $HP_actual;
        $this->MP_actual = $MP_actual;
    }
    
    // Calculate the maximum HP based on attributes
    public function calculateHPMax() {
        return ($this->nivel * 10) + ($this->fuerzaBasic * 5) + ($this->fuerzaBonif * 10); //modificar
    }

    // Calculate the maximum MP based on attributes
    public function calculateMPMax() {
        return ($this->nivel * 5) + ($this->magiaBasic * 10) + ($this->magiaBonif * 5);
    }

    // Calculate physical attack based on attributes
    public function calculateAtkFisico() {
        return ($this->nivel * 2) + ($this->fuerzaBasic * 3) + ($this->fuerzaBonif * 2) + ($this->destrezaBasic);
    }

    // Calculate magical attack based on attributes
    public function calculateAtkMagico() {
        return ($this->nivel * 2) + ($this->magiaBasic * 4) + ($this->magiaBonif * 3) + ($this->destrezaBasic);
    }

    // Calculate physical defense based on attributes
    public function calculateDefensaFisica() {
        return ($this->nivel * 1) + ($this->fuerzaBasic) + ($this->resistenciaBasic * 2) + ($this->resistenciaBonif * 3);
    }

    // Calculate magical defense based on attributes
    public function calculateDefensaMagica() {
        return ($this->nivel * 1) + ($this->magiaBasic * 2) + ($this->resistenciaBasic) + ($this->resistenciaBonif * 3);
    }

    // Calculate hit rate based on attributes
    public function calculateHitRate() {
        return ($this->nivel * 5) + ($this->destrezaBasic * 2) + ($this->destrezaBonif * 5);
    }

    // Calculate attack speed based on attributes
    public function calculateAtkSpeed() {
        return ($this->destrezaBasic * 0.5) + ($this->destrezaBonif * 0.75);
    }

    // Calculate critical chance based on attributes
    public function calculateCritChance() {
        return ($this->destrezaBasic * 0.1) + ($this->destrezaBonif * 0.2);
    }
}
