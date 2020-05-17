<?php

namespace App\Console\Commands;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RoomUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'room:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update status room';

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
        
        $rooms = Room::where('trang_thai','full')->whereHas('bookRoom', function($query){
            $query->where('thoi_gian_ket_thuc','>=', Carbon::now()->sub('3 hours'));
        })->get();
        
        
        foreach ($rooms as $room) {
            $room->trang_thai = 'fulltime';
            $room->save();
        }

        print_r($rooms);  
    }
}
