<?php

abstract class AbstractSecretKeyFactory
{
    public static function getFactory() : AbstractSecretKeyFactory
    {
        return match(env('SECRET_KEY_SOURCE')) {
            'db' => new DatabaseSecretKeyFactory(),
            'file' => new FileSecretKeyFactory(),
            default => throw new InvalidArgumentException('Unknown factory given')
        };
    }

    abstract public function getKey();
}

class DatabaseSecretKeyFactory extends AbstractSecretKeyFactory
{
    public function getKey()
    {
        //
    }
}

class FileSecretKeyFactory extends AbstractSecretKeyFactory
{
    public function getKey()
    {
        //
    }
}



class SomeClass
{
    public function getUserData()
    {
        $url = 'https://some_url.com/api/user';
        $params = [
            'some_param_1' => 'some_value_1',
            'some_param_2' => 'some_value_2',
            'token' => $this->getSecretKey()
        ];

        return Http::get($url, $params)->json();
    }

    private function getSecretKey()
    {
        AbstractSecretKeyFactory::getFactory()->getKey();
    }
}