<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $userName;
    public $totalSales;


    public function __construct($sales, $userName, $totalSales)
    {
        $this->sales = $sales;
        $this->userName = $userName;
        $this->totalSales = $totalSales;

    }

    public function build()
    {
        return $this->from('goncalvessanches.mh@gmail.com', 'Gerente')
        ->view('emails.daily_report')
        ->subject('Relatório Diário');
    }
}
