<?php

namespace Sanjeevlabs\Contact\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class ContactConfirm extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Public properties which are available to the email template.
     *
     * @var Request
     * @var string
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->getSubject())->markdown('emails.contact.contact-confirm');
    }

    protected function getSubject()
    {
        return \Config('contact.subject.confirm');
    }
}
