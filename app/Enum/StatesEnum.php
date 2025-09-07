<?php

namespace App\Enum;

class StatesEnum {
 
    public static function getPrettyNames (): array {

        return [
            'Pendiente',
            'En Progreso',
            'Completado'
        ];

    }

    public static function getForOptions () {

        return [
            'todo' => 'Pendiente',
            'doing' => 'En Progreso',
            'done' => 'Completado'
        ];

    }
    
}