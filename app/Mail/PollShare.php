<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Poll;

class PollShare extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * poll url
     * @var string
     */
    private $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Poll $poll)
    {
        $this->url = url('/poll/token/' . $poll->token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(__('poll.email.subject'))
            ->markdown('mail.poll-share')
            ->with('url', $this->url);
    }
}
