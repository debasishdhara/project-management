<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Company;
use App\Licence;
use App\User;

class CompanyDailyCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $companys_details= Company::all();
            foreach ($companys_details as $key => $company) {
                $company_from = Carbon::createFromDate($company->company_from);
                $company_to = Carbon::createFromDate($company->company_to);
                $now = Carbon::now();
                $tvalidity=$company_to->diffInDays($company_from);
                $this->info($tvalidity);
                if($tvalidity>$company->company_validity){
                    User::where('company_id',$company->id)->update(array('user_status'=>false));
                    Company::where('id',$company->id)->update(array('company_status'=>false));
                }
            }
            $this->info('Company Details Check successfully');
    }
}
