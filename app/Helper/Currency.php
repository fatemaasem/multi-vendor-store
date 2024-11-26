<?php
namespace App\Helper;
use NumberFormatter;
class Currency{
    
    public static function getCurrencySymbolByCountry( $countryCode=null): string
    {
        if(!$countryCode)
             $countryCode = config('services.currency');     
        // Create a NumberFormatter instance with the locale and currency format
        $formatter = new NumberFormatter($countryCode, NumberFormatter::CURRENCY);

        // Get the currency symbol for the country code
        return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
    }
}
