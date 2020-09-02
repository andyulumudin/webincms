<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Authentication Check

        if (session()->login === true)
        {
            return redirect(ADMINURL);
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}