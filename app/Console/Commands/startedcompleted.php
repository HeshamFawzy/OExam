<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use DB;
use App\online_exam;
class startedcompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:startedcompleted';

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
        $online_exams = DB::table('online_exams')
            ->get();
        foreach ($online_exams as $online_exam) {
            if ($online_exam->online_exam_status == "started") {
                $now =  Carbon::now('Africa/Cairo')->timestamp;
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $online_exam->online_exam_datetime, 'Africa/Cairo')->timestamp;
                $difference = $now - $datetime;
                $duration = (int) $online_exam->online_exam_duration * 60;
                if ($difference > $duration) {
                    online_exam::where('online_exams.id', '=', $online_exam->id)->update([
                        'online_exam_status' => 'completed',
                    ]);
                }
            }
        }
    }
}
