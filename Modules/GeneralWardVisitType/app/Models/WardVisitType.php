<?php

namespace Modules\GeneralWardVisitType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralWardVisitType\Database\Factories\WardVisitTypeFactory;

class WardVisitType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active', 'triggers_emergency_flag'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'triggers_emergency_flag' => 'boolean',
        ];
    }

    protected static function newFactory(): WardVisitTypeFactory
    {
        return WardVisitTypeFactory::new();
    }
}
