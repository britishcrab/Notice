<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArrivalNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $title;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name = 'celexol', $url)
    {
        $this->name = $name;
        $this->url = $url;
        $this->title = sprintf('%sが入荷しました。', $name);
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.arrival_mail')
            ->subject($this->title)
            ->with([
                'content'=>$this->url,
            ]);
    }
}
