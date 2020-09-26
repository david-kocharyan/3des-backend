<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PromoCheck extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'promo:check';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Check promo code for performance';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return int
     */
    public function handle()
    {
        $coupon = Coupon::where('type', 1)->get();

        foreach ($coupon as $key => $val) {
            $startDate = Carbon::createFromFormat('Y-m-d', $val->start);
            $endDate = Carbon::createFromFormat('Y-m-d', $val->finish);
            $check = Carbon::now()->between($startDate, $endDate);

            if ($check == false) {
                try {
                    $val->type = 0;
                    $val->save();
                } catch (\Exception $exception) {
                    $this->info($exception->getMessage());
                }
            }
        }
        $this->info('Promo Code Check successfully');
    }
}
