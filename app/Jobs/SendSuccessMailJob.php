<?php

namespace App\Jobs;

use App\Mail\SendSuccessMailToUser;
use App\Mail\SendSuccessMailToOwner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSuccessMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $cartInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $cartInfo)
    {
        $this->cartInfo = $cartInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //商品購入者
        Mail::to(array_column($this->cartInfo, 'user_email')[0])
            ->send(new SendSuccessMailToUser($this->cartInfo));

        //購入商品の店舗オーナー
        foreach ($this->cartInfo as $key => $info) {
            if ($oldEmail ?? null === $info['owner_email']) { //同一アドレススキップ
                continue;
            } else {
                Mail::to($info['owner_email'])
                    ->send(new SendSuccessMailToOwner($this->cartInfo[$key]));
                $oldEmail = $info['owner_email'];
            }
        }
    }
}
