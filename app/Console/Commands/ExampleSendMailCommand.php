<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Mail\VerifiedUserRegisteredMail;
use Illuminate\Support\Facades\Mail;

class ExampleSendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for exemplify the mail sending in laravel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::to('amazuraa@gmail.com')->send(new VerifiedUserRegisteredMail());
    }
}