<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProbarCorreo extends Command
{
    protected $signature = 'correo:probar';

    protected $description = 'Prueba el envio de correo con Gmail';

    public function handle()
    {
        Mail::raw('Este es un correo de prueba enviado desde Laravel.', function ($mensaje) {
            $mensaje->to('')//este espacio espara ingresar el correo y asegurarse de que sirva
                ->subject('Prueba de correo Laravel');
        });

        $this->info('Correo enviado correctamente.');
    }
}
