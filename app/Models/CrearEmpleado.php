<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrearEmpleado extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ROL_SELECT = [
        '0'  => 'Crew',
        '86' => 'Asistente',
    ];

    public const RESTAURANTE_SELECT = [
        'p00_loteria'      => 'P00 - Loteria - Lotto',
        'p36_sanmiguelito' => 'P36 - San Miguelito - Transmac',
        'p40_calle13'      => 'P40 - Calle 13 - Tropimac',
        'p42_sabanitas'    => 'P42 - Sabanitas - Caribbean',
        'p49_carrusel'     => 'P49 - Carrusel - Albrook',
        'p50_multiplaza'   => 'P50 - Multiplaza - Plaza',
        'p53_villa'        => 'P53 - Villas - Dorado',
        'p58_lomas'        => 'P58 - Lomas del Golf',
        'p60_ten'          => 'P60 - Ten Foods',
        'p61_west'         => 'P61 - West Terminal',
        'p77_calle8'       => 'P77 - Calle 8 -',
        'p87_costa'        => 'P87 - Costa del Este',
        'p91_paraiso'      => 'P91 - Paraiso',
    ];

    public $table = 'crear_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'codigo_empleado',
        'rol',
        'restaurante',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
