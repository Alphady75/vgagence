<?php

namespace App\Service;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;

class MailerService {

	public function __construct(private MailerInterface $mailer){

	}

	public function sendMail($from, $to, $message, $username){
		// Envoie de mail
		$email = (new TemplatedEmail())
			->from($from)
			->to($to)
			->subject('Mail de contact depuis le site')
			->htmlTemplate('contact/composants/_email.html.twig')
			->context([
				'user' => $username,
				'useremail'  =>  $from,
				'message'   =>  $message
			])
		;

		return $this->mailer->send($email);
	}

}