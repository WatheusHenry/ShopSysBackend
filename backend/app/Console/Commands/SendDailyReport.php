<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReportMail;

class SendDailyReport extends Command
{
    protected $signature = 'email:send-daily-report';

    protected $description = 'Envia o relatório diário por email';
    
    
    
    public function handle()
    {
        $recipientEmail = env('MAIL_FROM_ADDRESS');
        
        Mail::to($recipientEmail)->send(new DailyReportMail());

        $this->info('Email enviado com sucesso!');
    }
}
