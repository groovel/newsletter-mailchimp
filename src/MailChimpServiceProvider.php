<?php 

namespace Groovel\MailChimp;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use Monolog\Logger;
use Groovel\MailChimp\services\MailChimpClient;


class MailChimpServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
  
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
	{
		$this->setupConfig($this->app);
    }
    
    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = __DIR__.'/config/MailChimpConfig.php';
        $this->publishes([$source => config_path('MailChimpConfig.php')]);
        $this->mergeConfigFrom($source, 'mailchimp');
         
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings($this->app);
    }
    /**
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->singleton('mailchimp', function ($app) {
            $config = $app['config'];
            return new MailChimpClient(
                $config->get('mailchimp.token_user'),
            	$config->get('mailchimp.base_uri'),
            	$config->get('mailchimp.version')
             );
        });
        
    	
     }
     
     public function provides()
     {
     	return array('mailchimp');
     }
 
}