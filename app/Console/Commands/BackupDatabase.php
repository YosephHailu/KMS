<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use symfony\Component\Process\Exception\ProcessFailedException;
// use symfony\Component\Process\Exception\ProcessFailedException;

// class BackupDatabase extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'db:backup';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Back up database';

//     protected $process;
//     /**
//      * Create a new command instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         parent::__construct();

//         $this->process = new Process(sprintf(
//             'mysqldump -u%s -p%s %s > %s',
//             config('database.connect.mysql.username'),
//             config('database.connect.mysql.password'),
//             config('database.connect.mysql.database'),
//             storage_path('backups/backup.sql')
//         ));
//     }

//     /**
//      * Execute the console command.
//      *
//      * @return mixed
//      */
//     public function handle()
//     {
//         //
//         try{
//             $this->process->mustRun();

//             $this->info('The backup has been taken');
//         }catch(ProcessFailedException $exception){
//             $this->error('Backup process failed');
//         }
//     }
// }
