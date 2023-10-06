<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\orderConfirmation;
use App\Mail\orderPlaced;
use Illuminate\Support\Facades\Mail;

class OrderMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	protected $orders_id;
	protected $custom_order_id;
	protected $email_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orders_id, $custom_order_id, $email_id)
    {
        $this->orders_id = $orders_id;
        $this->custom_order_id = $custom_order_id;
        $this->email_id = $email_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email_id)->send(new orderConfirmation($this->orders_id, $this->custom_order_id));
		Mail::to('sajan@tccggd.com')->send(new orderPlaced());
    }
}
