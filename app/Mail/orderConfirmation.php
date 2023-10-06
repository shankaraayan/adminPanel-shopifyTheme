<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderConfirmation extends Mailable
{
    use Queueable, SerializesModels;
	public $orders_id;
	public $custom_order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders_id, $custom_order_id)
    {
        $this->orders_id = $orders_id;
        $this->custom_order_id = $custom_order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.orderConfirmation');
    }
}
