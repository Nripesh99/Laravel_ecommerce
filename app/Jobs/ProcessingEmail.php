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

class ProcessingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $orderdetail;
    protected $userEmail;
    public function __construct($orderdetail,$userEmail)
    {
        $this->orderdetail = $orderdetail;
        $this->userEmail = $userEmail;
        

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orderDetail=$this->orderdetail;
        $userEmail=$this->userEmail;
        $order=array();
        foreach($orderDetail as $orderd){
    
            $order[] = Order_detail::where('id', $orderd)->get();
        }
        $user=User::where('id',auth()->id());
        Mail::to($userEmail)->send(new OrderEmail($order));
    }
}
