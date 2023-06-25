<?php
namespace Waseem\Encipher;
use Illuminate\Support\Facades\Config;

class Encrypter
{
    private $method;
    private $key;
    private $prefix;

    /**
     * @param $value
     * @return string
     */
    public function encrypt($value)
    {
        return $this->getPrefix() . '_' . openssl_encrypt($value, $this->method, $this->getKey(), 0, $iv = '');
    }

    /**
     * @param $value
     * @return string
     */
    public function decrypt($value)
    {
        $value = str_replace("{$this->getPrefix()}_",'',$value);

        return openssl_decrypt($value, $this->method, $this->getKey(), 0, $iv = '');
    }


    /**
     * @return bool|null|string
     * @throws \Exception
     */
    public function getKey()
    {
        if ($this->key === null) {
            if(! Config::get('encrypt.key')) throw new \Exception('The .env value SECRET_ENCRYPT_KEY has to be set');
            $this->key = substr(hash('sha256', Config::get('encrypt.key')), 0, 16);
        }
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        if(! $this->prefix){
            $this->prefix = Config::get('encrypt.prefix');
        }
        return $this->prefix;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        if(! $this->method){
            $this->method = Config::get('encrypt.method');
        }
        return $this->method;
    }

}