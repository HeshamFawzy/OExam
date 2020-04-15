<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use DB;
use App\online_exam;
class pendingstarted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:pendingstarted';

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
        $now =  Carbon::now('Africa/Cairo')->timestamp;
        $online_exams = DB::table('online_exams')
            ->get();

        foreach ($online_exams as $online_exam) {
            if ($online_exam->online_exam_status == "pending...") {
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $online_exam->online_exam_datetime, 'Africa/Cairo')->timestamp;
                if ($datetime < $now) {
                    online_exam::where('online_exams.id', '=', $online_exam->id)->update([
                        'online_exam_status' => 'started',
                    ]);
                }
            }
        }
    }
}
