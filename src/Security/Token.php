<?php


namespace App\Security\Token;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;


class Token
{

    public $created;
    public $digest;
    public $nonce;

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // Если пользователь имеет роли, считайте его аутентифицированным
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }

}