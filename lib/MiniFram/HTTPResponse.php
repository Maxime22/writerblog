<?php
namespace MiniFram;

class HTTPResponse extends ApplicationComponent
{
    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    public function redirect404()
    {
        $this->page = new Page($this->app);
        
        $this->page->setContentFile(__DIR__ . '/../../Errors/404.html');

        $this->addHeader('HTTP/1.0 404 Not Found');

        $this->send('Frontend');
    }

    public function send($appName=null) // to have the frontEnd error page in the generatedPage
    {
        exit($this->page->getGeneratedPage($appName));
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    // last param to true is a security
    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
