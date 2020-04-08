<?php

namespace App\Http\Traits;


use Carbon\Carbon;
use Exception;
use InvalidArgumentException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use SplFileObject;

trait ManagesToken
{
    /**Create Token with rsa sha256
     * @param $user
     * @param array $claims
     * @return Token
     */
    public function createTokenFor($user, array $claims = [])
    {
        $builder = (new Builder());

        $builder->issuedBy(config('app.url'));
        $builder->permittedFor(config('app.url'));
        $builder->relatedTo($user);
        $builder->expiresAt(Carbon::now()->addHour()->getTimestamp());
        foreach ($claims as $key => $value) {
            $builder->withClaim($key, $value);
        }

        $signer = $this->getSigner();
        $key = $this->readKey('private_key.pem');
        return $builder->getToken($signer, new Key($key));
    }

    public function checkToken($token)
    {
        $decryptedToken = $this->decryptToken($token);
        if (!$this->validateToken($decryptedToken)) {
            return false;
        }

        if (!$this->verifyToken($decryptedToken)) {
            return false;
        }

        return $decryptedToken;
    }

    /**Decrypt the token
     * @param $token
     * @return bool|Token
     */
    private function decryptToken($token)
    {
        return (new Parser())->parse((string)$token);
    }


    /**
     * @param $token
     * @return mixed
     */
    private function validateToken(Token $token)
    {
        $data = new ValidationData();
        return $token->validate($data);
    }

    /**
     * @param $token
     * @return mixed
     */
    private function verifyToken(Token $token)
    {
        $signer = $this->getSigner();
        $key = $this->readKey('public_key.pem');
        return $token->verify($signer, new Key($key));
    }

    private function readKey($file)
    {
        try {
            $file = new SplFileObject(storage_path("keys/$file"));

            $content = '';
            while (!$file->eof()) {
                $content .= $file->fgets();
            }

            return $content;
        } catch (Exception $exception) {
            throw new InvalidArgumentException('You must provide a valid key file', 0, $exception);
        }
    }

    private function getSigner()
    {
        return new Sha256();
    }
}
