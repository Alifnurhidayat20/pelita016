<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PenarikanNotification extends Notification
{
    use Queueable;

    protected $penarikan;
    protected $status;

    public function __construct($penarikan, $status)
    {
        $this->penarikan = $penarikan;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $statusText = $this->status == 'disetujui' ? 'Disetujui' : 'Ditolak';
        $statusColor = $this->status == 'disetujui' ? 'green' : 'red';
        
        return (new MailMessage)
            ->subject('Status Penarikan Saldo - PELITA 016')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Permintaan penarikan saldo Anda telah ' . strtolower($statusText) . '.')
            ->line('Jumlah Penarikan: Rp ' . number_format($this->penarikan->jumlah, 0, ',', '.'))
            ->line('Kode Penarikan: ' . $this->penarikan->kode_penarikan)
            ->action('Lihat Detail', url('/nasabah/riwayat'))
            ->line('Terima kasih telah menjadi nasabah PELITA 016!');
    }

    public function toArray($notifiable)
    {
        return [
            'penarikan_id' => $this->penarikan->id,
            'kode_penarikan' => $this->penarikan->kode_penarikan,
            'jumlah' => $this->penarikan->jumlah,
            'status' => $this->status,
            'message' => 'Penarikan saldo sebesar Rp ' . number_format($this->penarikan->jumlah, 0, ',', '.') . ' ' . ($this->status == 'disetujui' ? 'disetujui' : 'ditolak')
        ];
    }
}