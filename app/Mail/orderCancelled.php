<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderCancelled extends Mailable
{
    use Queueable, SerializesModels;
	public $orders;
	public $Orders_customers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $Orders_customers)
    {
        $this->orders = $orders;
        $this->Orders_customers = $Orders_customers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.orderCancelled');
    }
}
