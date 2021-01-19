<?php

namespace App\Console\Commands;

use App\Models\Bank;
use Illuminate\Console\Command;

class addBank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank-add {name} {identify}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new bank';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $identify = $this->argument('identify');
        $hasIdentify = Bank::where('identify',$identify)->count();
        $hasBankName = Bank::where('name',$name)->count();
        if(strlen($identify)!=4){
            $this->error("identify:$identify must have 4 char " );
            return;
        }
        if ($hasIdentify){
            $this->error("bank with identify:$identify exits try again " );
        }
         if($hasBankName){
            $this->error("bank with name:$name exits try again " );
        }
        else{
            Bank::create(['name'=>$name,'identify'=>$identify]);
            $this->info("Bank:{$name} , identify:{$identify} added");
        }

    }
}
