<?php

namespace App\Console\Commands;

use App\Blog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BlogPublish extends Command
{

    protected $signature = 'blog:publish';

    protected $description = 'This command is for publishing blog as per admin schedule';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
       Blog::where(['status'=> 'schedule'])->whereDate('schedule_date' ,'>=', Carbon::now())->update(['status' =>'publish']);
       Log::info('blog schedule work complete'.Carbon::now()->format('D, d m y h:i:s'));
       $this->info('blog schedule work complete');
       return Command::SUCCESS;
    }
}
