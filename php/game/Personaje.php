class Personaje {
    private $nombre;
    private $clase;
    private $nivel;
    private $fuerzaBasic;
    private $resistenciaBasic;
    private $destrezaBasic;
    private $magiaBasic;
    private $fuerzaBonif;
    private $resistenciaBonif;
    private $destrezaBonif;
    private $magiaBonif;
    private $statPoint;

    private $HP_Max;
    private $MP_Max;
    private $Atk_Fisico;
    private $Atk_Magico;
    private $Defensa_fisica;
    private $Defensa_Magica;
    private $Hit_rate;
    private $atk_speed;
    private $Crit_chance;

    private $HP_actual;
    private $MP_actual;

    //=============================CONSTRUCTOR=============================

    // Función para aplicar bonificación según la clase del personaje
    private function Clase_bonif() {
        switch ($this->clase) {
            case 'Bárbaro':
                $this->fuerzaBonif += 5;
                break;
            case 'Mago':
                $this->magiaBonif += 5;
                break;
            case 'Cazador':
                $this->destrezaBonif += 5;
                break;
            case 'Guerrero':
                $this->resistenciaBonif += 5;
                break;
            default:
                // Si la clase no coincide con ninguna opción, no se aplica bonificación.
                break;
        }
    }

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

        // Llamar a la función para aplicar bonificación de clase
        $this->Clase_bonif();
    }

    //=============================GETTERS=============================

    // Getter para obtener el nombre del personaje
    public function getNombre() {
        return $this->nombre;
    }

    // Getter para obtener la clase del personaje
    public function getClase() {
        return $this->clase;
    }

    // Getter para obtener el nivel del personaje
    public function getNivel() {
        return $this->nivel;
    }

    // Getter para obtener el HP máximo del personaje
    public function getHPMax() {
        return $this->HP_Max;
    }

    // Getter para obtener el MP máximo del personaje
    public function getMPMax() {
        return $this->MP_Max;
    }

    // Getter para obtener la fuerza básica del personaje
    public function getFuerzaBasic() {
        return $this->fuerzaBasic;
    }

    // Getter para obtener la resistencia básica del personaje
    public function getResistenciaBasic() {
        return $this->resistenciaBasic;
    }

    // Getter para obtener la destreza básica del personaje
    public function getDestrezaBasic() {
        return $this->destrezaBasic;
    }

    // Getter para obtener la magia básica del personaje
    public function getMagiaBasic() {
        return $this->magiaBasic;
    }

    // Getter para obtener la fuerza bonificada del personaje
    public function getFuerzaBonif() {
        return $this->fuerzaBonif;
    }

    // Getter para obtener la resistencia bonificada del personaje
    public function getResistenciaBonif() {
        return $this->resistenciaBonif;
    }

    // Getter para obtener la destreza bonificada del personaje
    public function getDestrezaBonif() {
        return $this->destrezaBonif;
    }

    // Getter para obtener la magia bonificada del personaje
    public function getMagiaBonif() {
        return $this->magiaBonif;
    }

    // Getter para obtener los puntos de estadísticas del personaje
    public function getStatPoint() {
        return $this->statPoint;
    }

    // Getter para obtener el ataque físico del personaje
    public function getAtkFisico() {
        return $this->Atk_Fisico;
    }

    // Getter para obtener el ataque mágico del personaje
    public function getAtkMagico() {
        return $this->Atk_Magico;
    }

    // Getter para obtener la defensa física del personaje
    public function getDefensaFisica() {
        return $this->Defensa_fisica;
    }

    // Getter para obtener la defensa mágica del personaje
    public function getDefensaMagica() {
        return $this->Defensa_Magica;
    }

    // Getter para obtener la tasa de acierto (Hit rate) del personaje
    public function getHitRate() {
        return $this->Hit_rate;
    }

    // Getter para obtener la velocidad de ataque del personaje
    public function getAtkSpeed() {
        return $this->atk_speed;
    }

    // Getter para obtener la probabilidad de golpe crítico del personaje
    public function getCritChance() {
        return $this->Crit_chance;
    }

    //=============================FORMULAS Y CALCULOS=============================
    
    // Calculate the maximum HP based on attributes
    private function calculateHPMax() {
        return ($this->nivel * 10) + ($this->fuerzaBasic * 5) + ($this->fuerzaBonif * 10); //modificar
    }

    // Calculate the maximum MP based on attributes
    private function calculateMPMax() {
        return ($this->nivel * 5) + ($this->magiaBasic * 10) + ($this->magiaBonif * 5);
    }

    // Calculate physical attack based on attributes
    private function calculateAtkFisico() {
        return ($this->nivel * 2) + ($this->fuerzaBasic * 3) + ($this->fuerzaBonif * 2) + ($this->destrezaBasic);
    }

    // Calculate magical attack based on attributes
    private function calculateAtkMagico() {
        return ($this->nivel * 2) + ($this->magiaBasic * 4) + ($this->magiaBonif * 3) + ($this->destrezaBasic);
    }

    // Calculate physical defense based on attributes
    private function calculateDefensaFisica() {
        return ($this->nivel * 1) + ($this->fuerzaBasic) + ($this->resistenciaBasic * 2) + ($this->resistenciaBonif * 3);
    }

    // Calculate magical defense based on attributes
    private function calculateDefensaMagica() {
        return ($this->nivel * 1) + ($this->magiaBasic * 2) + ($this->resistenciaBasic) + ($this->resistenciaBonif * 3);
    }

    // Calculate hit rate based on attributes
    private function calculateHitRate() {
        return ($this->nivel * 5) + ($this->destrezaBasic * 2) + ($this->destrezaBonif * 5);
    }

    // Calculate attack speed based on attributes
    private function calculateAtkSpeed() {
        return ($this->destrezaBasic * 0.5) + ($this->destrezaBonif * 0.75);
    }

    // Calculate critical chance based on attributes
    private function calculateCritChance() {
        return ($this->destrezaBasic * 0.1) + ($this->destrezaBonif * 0.2);
    }
}
