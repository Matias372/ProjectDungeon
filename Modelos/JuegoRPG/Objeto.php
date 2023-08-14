class Objeto {
    public $id;
    public $nombre;
    public $descripcion;
    public $tipo;

    public function __construct($id, $nombre, $descripcion, $tipo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
    }
}

//==========CLASES DERIVADAS==========

class Consumible extends Objeto {
    public $efectoAtributo;
    public $cantidadAfecta;
    public $usarEnBatalla;
    public $precioCompra;
    public $precioVenta;

    public function __construct($id, $nombre, $descripcion, $tipo, $efectoAtributo, $cantidadAfecta, $usarEnBatalla, $precioCompra, $precioVenta) {
        parent::__construct($id, $nombre, $descripcion, $tipo);
        $this->efectoAtributo = $efectoAtributo;
        $this->cantidadAfecta = $cantidadAfecta;
        $this->usarEnBatalla = $usarEnBatalla;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
    }
}

class Equipo extends Objeto {
    public $nivelMinimo;
    public $tipoEquipo;
    public $estadisticasFisicas; // Estadísticas físicas del equipo
    public $estadisticasMagicas; // Estadísticas mágicas del equipo
    public $precioCompra;
    public $precioVenta;
    public $claseRequerida;

    public function __construct($id, $nombre, $descripcion, $tipo, $nivelMinimo, $tipoEquipo, $estadisticasFisicas, $estadisticasMagicas, $precioCompra, $precioVenta, $claseRequerida) {
        parent::__construct($id, $nombre, $descripcion, $tipo);
        $this->nivelMinimo = $nivelMinimo;
        $this->tipoEquipo = $tipoEquipo;
        $this->estadisticasFisicas = $estadisticasFisicas;
        $this->estadisticasMagicas = $estadisticasMagicas;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
        $this->claseRequerida = $claseRequerida;
    }
}

class Material extends Objeto {
    public $precioVenta;

    public function __construct($id, $nombre, $descripcion, $tipo, $precioVenta) {
        parent::__construct($id, $nombre, $descripcion, $tipo);
        $this->precioVenta = $precioVenta;
    }
}

class Mision extends Objeto {
    public $tipoObjetivo;
    public $cantidadNecesaria;
    public $cantidadActual;
    public $nivelMinimo;
    public $experienciaRecompensa;
    public $oroRecompensa;

    public function __construct($id, $nombre, $descripcion, $tipo, $tipoObjetivo, $cantidadNecesaria, $nivelMinimo, $experienciaRecompensa, $oroRecompensa) {
        parent::__construct($id, $nombre, $descripcion, $tipo);
        $this->tipoObjetivo = $tipoObjetivo;
        $this->cantidadNecesaria = $cantidadNecesaria;
        $this->cantidadActual = 0;
        $this->nivelMinimo = $nivelMinimo;
        $this->experienciaRecompensa = $experienciaRecompensa;
        $this->oroRecompensa = $oroRecompensa;
    }
}



//==========LISTA DE OBJETOS==========

//========================================CONSUMIBLE========================================
// Crear instancia de consumible (poción I)
$PocióndeCura = new Consumible(
    CP_0001,
    "Poción de Cura",
    "Restaura 70 de salud.",
    "consumible",
    "vida",
    70,
    true,
    40,
    5
);

// Crear instancia de consumible (poción II)
$ExtractoRestaurador = new Consumible(
    CE_0002,
    "Extracto Restaurador",
    "Restaura 140 de salud.",
    "consumible",
    "vida",
    140,
    true,
    70,
    8
);

// Crear instancia de consumible (poción III)
$AguadeVida = new Consumible(
    CA_0003,
    "Agua de Vida",
    "Restaura 200 de salud.",
    "consumible",
    "vida",
    200,
    true,
    100,
    12
);

// Crear instancia de consumible (poción IV)
$JarabedeRecuperación = new Consumible(
    CJ_0004,
    "Jarabe de Recuperación",
    "Restaura 260 de salud.",
    "consumible",
    "vida",
    260,
    true,
    140,
    17
);

// Crear instancia de consumible (poción V)
$PociónCurativa = new Consumible(
    CP_0005,
    "Poción Curativa",
    "Restaura 325 de salud.",
    "consumible",
    "vida",
    325,
    true,
    155,
    20
);

// Crear instancia de consumible (poción VI)
$BebidaReconstituyente = new Consumible(
    CB_0006,
    "Bebida Reconstituyente",
    "Restaura 430 de salud.",
    "consumible",
    "vida",
    430,
    true,
    222,
    25
);

// Crear instancia de consumible (poción VII)
$TónicodeSanación = new Consumible(
    CT_0007,
    "Tónico de Sanación",
    "Restaura 580 de salud.",
    "consumible",
    "vida",
    580,
    true,
    277,
    34
);

// Crear instancia de consumible (poción VIII)
$BrebajedeSalud = new Consumible(
    CB_0008,
    "Brebaje de Salud",
    "Restaura 725 de salud.",
    "consumible",
    "vida",
    725,
    true,
    365,
    45
);

// Crear instancia de consumible (poción IX)
$InfusióndeEnergía = new Consumible(
    CI_0009,
    "Infusión de Energía",
    "Restaura 980 de salud.",
    "consumible",
    "vida",
    980,
    true,
    455,
    55
);

// Crear instancia de consumible (poción X)
$ElixirdeVitalidad = new Consumible(
    CE_0010,
    "Elixir de Vitalidad",
    "Restaura 1234 de salud.",
    "consumible",
    "vida",
    1234,
    true,
    589,
    78
);

// Crear instancia de consumible (bebida I)
$AguaMística = new Consumible(
    CA_0011,
    "Agua Mística",
    "Restaura 65 de mana.",
    "consumible",
    "vida",
    65,
    true,
    330,
    40
);

// Crear instancia de consumible (bebida II)
$LicordeManá = new Consumible(
    CL_0012,
    "Licor de Maná",
    "Restaura 125 de mana.",
    "consumible",
    "vida",
    125,
    true,
    390,
    48
);

// Crear instancia de consumible (bebida III)
$TédeHechicería = new Consumible(
    CT_0013,
    "Té de Hechicería",
    "Restaura 185 de mana.",
    "consumible",
    "vida",
    185,
    true,
    440,
    55
);

// Crear instancia de consumible (bebida IV)
$BebidaMágica = new Consumible(
    CB_0014,
    "Bebida Mágica",
    "Restaura 250 de mana.",
    "consumible",
    "vida",
    250,
    true,
    500,
    65
);

// Crear instancia de consumible (bebida V)
$BrebajedeMagia = new Consumible(
    CB_0015,
    "Brebaje de Magia",
    "Restaura 315 de mana.",
    "consumible",
    "vida",
    315,
    true,
    520,
    70
);

// Crear instancia de consumible (bebida VI)
$TónicodeEnergía = new Consumible(
    CT_0016,
    "Tónico de Energía",
    "Restaura 375 de mana.",
    "consumible",
    "vida",
    375,
    true,
    600,
    78
);

// Crear instancia de consumible (bebida VII)
$PocióndeManá = new Consumible(
    CP_0017,
    "Poción de Maná",
    "Restaura 450 de mana.",
    "consumible",
    "vida",
    450,
    true,
    750,
    92
);

// Crear instancia de consumible (bebida VIII)
$ElixirArcano = new Consumible(
    CE_0018,
    "Elixir Arcano",
    "Restaura 525 de mana.",
    "consumible",
    "vida",
    525,
    true,
    987,
    123
);

//========================================EQUIPO========================================

// Crear instancia de equipo
$espadaBasica = new Equipo(
    "EE_0001",
    "Espada Básica",
    "Una espada simple para principiantes.",
    "equipo",
    1,
    "arma",
    5, // Solo daño físico
    0, // Sin daño mágico
    50,
    25,
    "guerrero"
);

// Crear instancia de equipo (Bastón Mágico)
$bastonMagico = new Equipo(
    "EE_0002",
    "Bastón Mágico",
    "Un bastón que canaliza el poder mágico.",
    "equipo",
    1,
    "arma",
    0, // Solo daño mágico
    5, // Sin daño físico
    60,
    30,
    "mago"
);

//========================================MISION========================================

// Crear instancia de misión
$misionBasica = new Mision(
    QP_00##,
    "Misión Básica",
    "Completa una tarea sencilla para ganar recompensas.",
    "mision",
    "material",
    10,
    1,
    100,
    50
);

//========================================MATERIAL========================================

// Crear instancia de material
$nucleoVerde = new Material(
    MN_0019,
    "Núcleo Verde",
    "Un material de color verde brillante.",
    "material",
    15
);