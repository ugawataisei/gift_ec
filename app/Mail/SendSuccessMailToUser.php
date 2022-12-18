<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSuccessMailToUser extends Mailable
{
    use Queueable, SerializesModels;

    protected array $cartInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $cartInfo)
    {
        $this->cartInfo = $cartInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.to-user')->with([
            'success_message' => '商品の購入ありがとうございました。',
            'cartInfo' => $this->cartInfo,
        ]);
    }
}
