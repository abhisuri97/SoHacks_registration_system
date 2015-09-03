<?php

require_once 'vendor/autoload.php';
$client = new HelloSign\Client('2e80c01194e104ebfbcc1fdf6d625ecb40a72387f6ffcdf4ba073afd89c99839');
// $response = $client->getSignatureRequest('7594bca40df80a2555a856b5a022a12d7265344d');
// if ($response->isComplete()) {
//     echo 'All signers have signed this request.';
// } else {
//     foreach ($response->getSignatures() as $signature) {
//         echo $signature->getStatusCode() . "\n";
//     }
// }
$request = new HelloSign\SignatureRequest;
$request->enableTestMode();
$request->setTitle("NDA with Acme Co.");
$request->setSubject("The NDA we talked about");
$request->setMessage("Please sign this NDA and then we can discuss more. Let me know if you have any
questions.");
$request->addSigner(new HelloSign\Signer(array(
    'name' => "Jill",
    'email_address' => "suriabhinav1997@gmail.com"
)));
$request->addFile('public/sponsorship.pdf');
$request->setFormFieldsPerDocument(
    array( //everything
        array( //document 1
            array( //component 1
                "api_id" => 'signature_0656deb6',
                "name" => "",
                "type"=> "signature",
                "x" => 100,
                "y" => 300,
                "width" => 100,
                "height" => 16,
                "required" => true,
                "signer" => 0
            ),
            array( //component 2
                "api_id" => 'date_77da448c',
                "name" => "",
                "type" => "date_signed",
                "x" => 100,
                "y" => 310,
                "width" => 100,
                "height" => 16,
                "required" => true,
                "signer" => 0
            ),
            array( //component 3
                "api_id" => 'signature_cd2def5c',
                "name" => "",
                "type" => "signature",
                "x" => 250,
                "y" => 300,
                "width" => 100,
                "height" => 16,
                "required" => true,
                "signer" => 0
            ),
            array( //component 4
                "api_id" => 'date_60329879',
                "name" => "",
                "type" => "date_signed",
                "x" => 250,
                "y" => 320,
                "width" => 100,
                "height" => 16,
                "required" => true,
                "signer" => 0
            )
        )
    )
);

$response = $client->sendSignatureRequest($request);
// $signature = $response->getSignatures();
// $signature_id = $signature[0]->getId();
// print_r($signature_id);

A very simple PHP example that sends a HTTP POST to a remote site


?>



