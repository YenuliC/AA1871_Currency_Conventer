<?php

namespace Bookcatalog;

class BookService
{  
    /**
     * @soap
     * @param Bookcatalog\Transfer $status_details
     * @return string
     */
    public function currency_convert($status_details)
    {
        $sourceCurrency_basic = $this->get_details($status_details->sourceCurrency);
        $target_currency_basic = $this->get_details($status_details->targetCurrency);
        $currency_calculation = ($status_details->amountInSourceCurrency/$sourceCurrency_basic)*$target_currency_basic;
        return $currency_calculation;
    }

    function get_details($details)
    {
        $details_json = file_get_contents('currency.json');
        $decode_file = json_decode($details_json, true);
        $currency_data = $decode_file['rates'];

        foreach ($currency_data as $currency_rates)
        {
            $target_currency = $currency_rates['target_currency'];
            $currency_value = $currency_rates['value'];

            if($target_currency == $details)
            {
                return $currency_value;
            }
        }
    }
}

