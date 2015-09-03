<?php

namespace sohacks\Text;

class Texter 
{
	protected $user;
	protected $client;
	protected $request;
	protected $templateid;
	public function __construct($user,$client,$user2)
	{
		$this->user = $user;

		$this->client = $client;

		$this->user2 = $user2;

	}

	public function text($from, $to,$body) 
	{
		$message = $this->client->account->messages->sendMessage($from,$to,$body);
		// $this->request->setTemplateId($this->templateid);
		// $this->request->setTitle('A Waiver from SoHacks and HelloSign');
		// $this->request->setSubject('Sohacks waiver');
		// $this->request->setMessage('Click the link below to get started with the waiver signing process. Let us know if you have any questions or issues! Email us at contact@sohacks.com. This waiver should be completed by a legal guardian/parent unless the attendee is a legal adult (18 or older)');
		// $this->request->setSigner('Parent', $to, $name);
		// $response = $this->client->sendTemplateSignatureRequest($this->request);
		// $signature = $response->getSignatures();
		// $signature_id = $signature[0]->getId();
		// $this->user->update([
		// 	'signature_id' => $signature_id
		// ]);
	}
	// public function specsign($to, $name) 
	// {
	// 	$this->request->setTemplateId($this->templateid);
	// 	$this->request->setTitle('A Waiver from SoHacks and HelloSign');
	// 	$this->request->setSubject('Sohacks waiver');
	// 	$this->request->setMessage('Click the link below to get started with the waiver signing process. Let us know if you have any questions or issues! Email us at contact@sohacks.com. This waiver should be completed by a legal guardian/parent unless the attendee is a legal adult (18 or older)');
	// 	$this->request->setSigner('Parent', $to, $name);
	// 	$response = $this->client->sendTemplateSignatureRequest($this->request);
	// 	$signature = $response->getSignatures();
	// 	$signature_id = $signature[0]->getId();
	// 	$this->user2->where('email',$to)->update([
	// 		'signature_id' => $signature_id
	// 	]);
	// }
}