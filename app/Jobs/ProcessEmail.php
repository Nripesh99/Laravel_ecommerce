<?php

namespace App\Jobs;

use App\Mail\OrderEmail;
use App\Models\Order_detail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $orderdetail;
    public function __construct($orderdetail)
    {
        $this->orderdetail = $orderdetail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orderDetail=$this->orderdetail;
        $order=array();
        foreach($orderDetail as $orderd){
            $order[]=Order_detail::findOrFail($orderd);
        }
        $user=User::findOrFail(auth()->id());
        Mail::to($user->email)->send(new OrderEmail($order));
    }
}
