<?php

class status
{
    public $amountInSourceamountInCurrency;
    public $sourceCurrency;
    public $targetCurrency;
}

class client
{
    public $instance = NULL;

    public function __construct()
    {
        $params = array(
            'location'=> 'http://localhost/software_architecture/server.php?wsdl',
            'uri'=>'http://localhost/software_architecture/server.php?wsdl',
            'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE);
        $this->instance = new SoapClient(NULL, $params);
    }

    public function Currency_Conversion($status_details)
    {
        return $this->instance->__soapCall('currency_convert',[$status_details]);
    }

}

if(isset($_POST['submit']))
{

    $source_currency_amount = $_POST['amount'];
    $source_currency = $_POST['source'];
    $target_currency = $_POST['target'];

    $client = new client;

    $status_details = new status();

    $status_details->amountInSourceCurrency = $source_currency_amount;

    $status_details->sourceCurrency = $source_currency;

    $status_details->targetCurrency = $target_currency;

    try
    {
    
        $return_data = $client->Currency_Conversion($status_details);
        header('location: index.php?message= Final convertion is : '.$return_data);

    }
    catch (Exception $e)
    {
        echo "Caught exception: ", $e->getMessage(), "\n";
    }


}



?>