<?php

namespace App\Mail;

use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Findpw extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $EmailVerify;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user ,EmailVerify $EmailVerify)
    {
        $this->user = $user;
        $this->EmailVerify = $EmailVerify;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Findpw',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }

    public function build()
    {
        $user = $this->user;
        $EmailVerify = $this->EmailVerify; 
        return $this->view('email.pw')
        ->with('user',$user)
        ->with('EmailVerify',$EmailVerify)
        ->subject('Fin.mate 비밀번호 변경 링크를 보내드립니다.');
    }
}
