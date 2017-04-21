<?php
namespace App\Extension;


use Twig_Extension;
use Twig_SimpleFunction;
use Laravel\Lumen\Routing\UrlGenerator;
use Illuminate\Session\SessionManager;

class Twig extends Twig_Extension
{
    /**
     * @var \Laravel\Lumen\Routing\UrlGenerator;
     */
    protected $url;

    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * Create a new url extension
     *
     * @param \Illuminate\Routing\UrlGenerator
     * @param \Illuminate\Contracts\Routing\Registrar
     */
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'App_Extension_Twig';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('route', [$this->url, 'route'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('session_has', function($key) {
                return session($key) !== null;
            }),
            new Twig_SimpleFunction('session_get', function($key) {
                $data = session($key);

                if ($data !== null) {
                    session([$key => null]);
                }
                
                return  $data;
            }),
        ];
    }

    public function url($path = null, $parameters = [], $secure = null)
    {
        return $this->url->to($path, $parameters, $secure);
    }

}
