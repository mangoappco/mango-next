<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece al núcleo de la aplicación.
namespace Mango\Core;

// Configura y envía correos mediante PHPMailer y SMTP.
final class ServicioCorreo
{
    // Recibe la configuración para no colocar credenciales dentro del código.
    public function __construct(private Config $config)
    {
    }

    // Envía el enlace de recuperación al correo indicado.
    public function enviarRecuperacion(string $destinatario, string $enlace): void
    {
        // En local no enviamos correo real; la vista mostrará el enlace de prueba.
        if ($this->esEntornoLocal()) {
            return;
        }

        // Comprueba que PHPMailer esté instalado antes de usarlo en producción.
        if (!class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
            throw new \RuntimeException('PHPMailer no está instalado. Ejecuta Composer antes de desplegar.');
        }

        // Importa las clases solo cuando se necesita enviar correo real.
        $correo = new \PHPMailer\PHPMailer\PHPMailer(true);
        $correo->isSMTP();
        $correo->Host = (string) $this->config->get('MAIL_HOST');
        $correo->Port = (int) $this->config->get('MAIL_PORT', '587');
        $correo->SMTPAuth = true;
        $correo->Username = (string) $this->config->get('MAIL_USERNAME');
        $correo->Password = (string) $this->config->get('MAIL_PASSWORD');
        $correo->CharSet = 'UTF-8';

        // Selecciona TLS o SSL según la configuración de HostGator.
        $encriptacion = $this->config->get('MAIL_ENCRYPTION', 'tls');
        $correo->SMTPSecure = $encriptacion === 'ssl'
            ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
            : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;

        // Define remitente, destinatario y contenido del mensaje.
        $correo->setFrom(
            (string) $this->config->get('MAIL_FROM_ADDRESS'),
            (string) $this->config->get('MAIL_FROM_NAME', 'ManGo!')
        );
        $correo->addAddress($destinatario);
        $correo->isHTML(false);
        $correo->Subject = 'Recuperación de contraseña';
        $correo->Body = "Recibimos una solicitud para restablecer tu contraseña.\n\n"
            . "Abre este enlace para continuar:\n"
            . $enlace
            . "\n\nEl enlace expira en una hora y solo puede utilizarse una vez.";

        // Envía el correo mediante el servidor SMTP configurado.
        $correo->send();
    }

    // Indica si todavía estamos en desarrollo local.
    public function esEntornoLocal(): bool
    {
        return in_array(
            $this->config->get('APP_ENV', 'local'),
            ['local', 'development'],
            true
        );
    }

    // Devuelve la URL base configurada para construir enlaces completos.
    public function urlAplicacion(): string
    {
        return (string) $this->config->get(
            'APP_URL',
            'http://localhost/proyectos/mango-next/public'
        );
    }
}