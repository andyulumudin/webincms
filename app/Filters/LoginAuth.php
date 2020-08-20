<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Authentication Check
        $session = session();

        if ($session->login == true)
        {
            return redirect('admin/dashboard');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}