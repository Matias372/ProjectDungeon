<?php
class Personaje{
    private $nombre;
    private $clase;
    private $nivel;
    //estadisticas basicas de clase
    private $fuerzaBasic;
    private $resistenciaBasic;
    private $destrezaBasic;
    private $magiaBasic;
    // estadisticas modificadas por usuario.
    private $fuerzaBonif;
    private $resistenciaBonif;
    private $destrezaBonif;
    private $magiaBonif;
    // puntos de estadistica para subir atributos de personaje
    private $statPoint;
    // estadisticas modificadas por equipos.
    private $fuerzaEquip;
    private $resistenciaEquip;
    private $destrezaEquip;
    private $magiaEquip;
    //atributos calculados
    private $HP_Max;
    private $MP_Max;
    private $Atk_Fisico;
    private $Atk_Magico;
    private $Def_Fisica;
    private $Def_Magica;
    private $Hit_rate;
    private $atk_speed;
    private $Crit_chance;
    private $FuerzaTotal;
    private $ResistenciaTotal;
    private $DestrezaTotal;
    private $MagiaTotal;

    //vida y mana actual del personaje
    private $HP_actual;
    private $MP_actual;
    //verifica la creacion del personaje nuevo o si ya es un personaje cargado.
    private $bonificacionesAplicadas;
    
    //======ESTADISTICAS PUBLICAS======
    public $Nombre;
    public $Clase;
    public $Nivel;
    public $Fuerza;
    Public $Resistencia;
    Public $Destreza;   
    public $Magia;
    public $PuntosEstado;
    public $HP;
    public $MP;
    public $HPMax;
    public $MPMax;
    public $Ataque_Fisico;
    public $Ataque_Magico;
    public $Defensa_Fisica;
    public $Defensa_Magica;
    public $Hit_Rate;
    public $Velocidad_Ataque;
    public $Critical_Chance;
    //COLOCAR MAS...


    //=============================CONSTRUCTOR=============================

    // Función para aplicar bonificación según la clase del personaje
    private function Clase_bonif() {
        switch ($this->clase) {
            case 'Barbaro':
                $this->fuerzaBasic = 15;
                $this->resistenciaBasic = 12;
                $this->destrezaBasic = 8;
                $this->magiaBasic = 5;
                break;
            case 'Guerrero':
                $this->fuerzaBasic = 12;
                $this->resistenciaBasic = 15;
                $this->destrezaBasic = 10;
                $this->magiaBasic = 5;
                break;
            case 'Cazador':
                $this->fuerzaBasic = 10;
                $this->resistenciaBasic = 10;
                $this->destrezaBasic = 15;
                $this->magiaBasic = 8;
                break;
            case 'Mago':
                $this->fuerzaBasic = 5;
                $this->resistenciaBasic = 8;
                $this->destrezaBasic = 10;
                $this->magiaBasic = 15;
                break;
            default:
                // Si la clase no coincide con ninguna opción, no se aplica bonificación.
                break;
        }
    }
    

    public function __construct($nombre, $clase, $nivel, $fuerzaBasic, $resistenciaBasic, $destrezaBasic, $magiaBasic, $fuerzaBonif, $resistenciaBonif, $destrezaBonif, $magiaBonif, $statPoint, $HP_actual, $MP_actual, $bonificacionesAplicadas, $fuerzaEquip, $resistenciaEquip, $destrezaEquip, $magiaEquip) {
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
        $this->fuerzaEquip = $fuerzaEquip;
        $this->resistenciaEquip = $resistenciaEquip;
        $this->destrezaEquip = $destrezaEquip;
        $this->magiaEquip = $magiaEquip;

        // verifica si ya se genero anteriormente el personaje
        if ($this->bonificacionesAplicadas == false) {
            $this->Clase_bonif();
            $this->bonificacionesAplicadas = true;
        }

        // Calculate and initialize the properties related to calculations
        $this->HP_Max = $this->calculateHPMax();
        $this->MP_Max = $this->calculateMPMax();
        $this->FuerzaTotal = $this->calculateFuerzaTotal();
        $this->ResistenciaTotal = $this->calculateResistenciaTotal();
        $this->DestrezaTotal = $this->calculateDestrezaTotal();
        $this->MagiaTotal = $this->calculateMagiaTotal();
        $this->Atk_Fisico = $this->calculateAtkFisico();
        $this->Atk_Magico = $this->calculateAtkMagico();
        $this->Def_Fisica = $this->calculateDefensaFisica();
        $this->Def_Magica = $this->calculateDefensaMagica();
        $this->Hit_rate = $this->calculateHitRate();
        $this->atk_speed = $this->calculateAtkSpeed();
        $this->Crit_chance = $this->calculateCritChance();
        $this->bonificacionesAplicadas = $bonificacionesAplicadas;

        // Initialize HP_actual and MP_actual with the values from HP_Max and MP_Max
        $this->HP_actual = $HP_actual;
        $this->MP_actual = $MP_actual;

        //SET variables publicas
        $this->Nombre = $this->nombre;
        $this->Clase = $this->clase;
        $this->Nivel = $this->nivel;
        $this->Fuerza = $this->FuerzaTotal;
        $this->Resistencia = $this->ResistenciaTotal;
        $this->Destreza = $this->DestrezaTotal;
        $this->Magia = $this->MagiaTotal;
        $this->PuntosEstado = $this->statPoint;
        $this->HP = $this->HP_actual;
        $this->MP = $this->MP_actual;
        $this->HPMax = $this->HP_Max;
        $this->MPMax = $this->MP_Max;
        $this->Ataque_Fisico = $this->Atk_Fisico;
        $this->Ataque_Magico = $this->Atk_Magico;
        $this->Defensa_Fisica = $this->Def_Fisica;
        $this->Defensa_Magica = $this->Def_Magica;
        $this->Hit_Rate = $this->Hit_rate;
        $this->Velocidad_Ataque = $this->atk_speed;
        $this->Critical_Chance = $this->Crit_chance;
    }

    //================================ACTUALIZAR ESTADO================================
    function refreshStats(){
        //calcular cambios en estado de personaje.
        $this->HP_Max = $this->calculateHPMax();
        $this->MP_Max = $this->calculateMPMax();
        $this->FuerzaTotal = $this->calculateFuerzaTotal();
        $this->ResistenciaTotal = $this->calculateResistenciaTotal();
        $this->DestrezaTotal = $this->calculateDestrezaTotal();
        $this->MagiaTotal = $this->calculateMagiaTotal();
        $this->Atk_Fisico = $this->calculateAtkFisico();
        $this->Atk_Magico = $this->calculateAtkMagico();
        $this->Def_Fisica = $this->calculateDefensaFisica();
        $this->Def_Magica = $this->calculateDefensaMagica();
        $this->Hit_rate = $this->calculateHitRate();
        $this->atk_speed = $this->calculateAtkSpeed();
        $this->Crit_chance = $this->calculateCritChance();

        //Publicas
        $this->Fuerza = $this->FuerzaTotal;
        $this->Resistencia = $this->ResistenciaTotal;
        $this->Destreza = $this->DestrezaTotal;
        $this->Magia = $this->MagiaTotal;
        $this->PuntosEstado = $this->statPoint;
        $this->HP = $this->HP_actual;
        $this->MP = $this->MP_actual;
        $this->HPMax = $this->HP_Max;
        $this->MPMax = $this->MP_Max;
        $this->Ataque_Fisico = $this->Atk_Fisico;
        $this->Ataque_Magico = $this->Atk_Magico;
        $this->Defensa_Fisica = $this->Def_Fisica;
        $this->Defensa_Magica = $this->Def_Magica;
        $this->Hit_Rate = $this->Hit_rate;
        $this->Velocidad_Ataque = $this->atk_speed;
        $this->Critical_Chance = $this->Crit_chance;
    }

   
    //============================= SETTERS =============================
    public function LevelUp(){
        $this->nivel += 1;

        $this->refreshStats();

        $this->HP_actual = $this->HP_Max;
        $this->MP_actual = $this->MP_Max;
        
    }
    public function UpFuerzaBonif(){
        $this->fuerzaBonif += 1;
        $this->statPoint -=1;
        $this->refreshStats();
    }
    public function UpDestrezaBonif(){
        $this->destrezaBonif += 1;
        $this->statPoint -=1;
        $this->refreshStats();
    }
    public function UpResistenciaBonif(){
        $this->resistenciaBonif += 1;
        $this->statPoint -=1;
        $this->refreshStats();
    }
    public function UpMagiaBonif(){
        $this->magiaBonif += 1;
        $this->statPoint -=1;
        $this->refreshStats();
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

    private function calculateFuerzaTotal(){
        return (($this->fuerzaBasic)+($this->fuerzaBonif)+($this->fuerzaEquip));
    }
    private function calculateResistenciaTotal(){
        return (($this->resistenciaBasic)+($this->resistenciaBonif)+($this->resistenciaEquip));
    }
    private function calculateDestrezaTotal(){
        return (($this->destrezaBasic)+($this->destrezaBonif)+($this->destrezaEquip));
    }
    private function calculateMagiaTotal(){
        return (($this->magiaBasic)+($this->magiaBonif)+($this->magiaEquip));
    }

    // Calculate physical attack based on attributes, including bonuses and equipment
    private function calculateAtkFisico() {
        return ($this->nivel * 2) + ($this->FuerzaTotal * 3) + ($this->destrezaBasic);
    }

    // Calculate magical attack based on attributes, including bonuses and equipment
    private function calculateAtkMagico() {
        return ($this->nivel * 2) + ($this->MagiaTotal * 4) + ($this->destrezaBasic);
    }

    // Calculate physical defense based on attributes, including bonuses and equipment
    private function calculateDefensaFisica() {
        return ($this->nivel * 1) + ($this->FuerzaTotal) + ($this->ResistenciaTotal * 2);
    }

    // Calculate magical defense based on attributes, including bonuses and equipment
    private function calculateDefensaMagica() {
        return ($this->nivel * 1) + ($this->MagiaTotal * 2) + ($this->ResistenciaTotal);
    }

    // Calculate hit rate based on attributes, including bonuses and equipment
    private function calculateHitRate() {
        return ($this->nivel * 5) + ($this->DestrezaTotal * 2);
    }

    // Calculate attack speed based on attributes, including bonuses and equipment
    private function calculateAtkSpeed() {
        return ($this->DestrezaTotal * 0.5);
    }

    // Calculate critical chance based on attributes, including bonuses and equipment
    private function calculateCritChance() {
        return ($this->DestrezaTotal * 0.1);
    }

    
}

?>