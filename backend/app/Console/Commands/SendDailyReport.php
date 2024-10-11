<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReportMail;
use App\Repositories\Contracts\SalesRepositoryInterface;


class SendDailyReport extends Command
{
    protected $signature = 'email:send-daily-report';
    protected $description = 'Envia o relatório diário por email';

    protected $salesRepository;

    
    public function __construct(SalesRepositoryInterface $salesRepository){
        parent::__construct();
        $this->salesRepository = $salesRepository;
    }



    public function handle()
    {
        $sales = $this->salesRepository->getAll();

        $userName = 'Teste';

        $recipientEmail = env('MAIL_FROM_ADDRESS');

        Mail::to($recipientEmail)->send(new DailyReportMail($sales, $userName));

        $this->info('Email enviado com sucesso!');
    }
}
