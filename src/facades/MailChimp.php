<?php 
namespace Groovel\MailChimp\facades;

use Illuminate\Support\Facades\Facade;
class MailChimp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mailchimp';
    }
    
}