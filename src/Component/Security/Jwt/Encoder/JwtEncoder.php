<?php
namespace Laventure\Component\Security\Jwt\Encoder;

use InvalidArgumentException;
use Laventure\Component\Security\Encoder\Traits\Base64UrlEncoder;
use Laventure\Component\Security\Jwt\Exception\InvalidSignatureException;
use Laventure\Component\Security\Jwt\Exception\TokenExpiredException;


/**
 * @JwtEncoder
 *
 * @see https://jwt.io/
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Jwt\Encoder
*/
class JwtEncoder implements JwtEncoderInterface
{

    use Base64UrlEncoder;



    /**
     * @param string $secretKey
    */
    public function __construct(private string $secretKey)
    {
    }




    /**
     * @inheritDoc
    */
    public function encode(array $data): string
    {
        $header    = $this->encodeJwtHeaders();
        $payload   = $this->encodeJwtPayload($data);
        $signature = $this->encodeSignature($header, $payload);

        return sprintf('%s.%s.%s', $header, $payload, $signature);
    }




    /**
     * @inheritDoc
     *
     * @throws InvalidSignatureException
     *
     * @throws TokenExpiredException
    */
    public function decode(string $string): array
    {
        $payload = $this->getPayloadFromParams($this->getTokenParams($string));

        if ($payload['exp'] < time()) {
            throw new TokenExpiredException();
        }

        return $payload;
    }





    /**
     * @return string
    */
    private function encodeJwtHeaders(): string
    {
        return $this->encodeUrlAsJson([
            "type" => "JWT",
            "alg"  => "HS256"
        ]);
    }




    /**
     * @param array $payload
     *
     * @return string
    */
    private function encodeJwtPayload(array $payload): string
    {
        return $this->encodeUrlAsJson($payload);
    }



    /**
     * @param string $format
     *
     * @return string
    */
    private function hash(string $format): string
    {
        return hash_hmac("sha256", $format, true);
    }




    /**
     * @param string $header
     *
     * @param string $payload
     *
     * @return string
    */
    private function makeSignature(string $header, string $payload): string
    {
        $format =  sprintf('%s.%s.%s', $header, $payload, $this->secretKey);

        return $this->hash($format);
    }




    /**
     * @param string $header
     *
     * @param string $payload
     *
     * @return string
    */
    private function encodeSignature(string $header, string $payload): string
    {
         return $this->encodeUrl($this->makeSignature($header, $payload));
    }




    /**
     * @param string $token
     *
     * @return array
    */
    private function getTokenParams(string $token): array
    {
        if(preg_match("/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/", $token, $matches) !== 1) {
            throw new InvalidArgumentException("invalid token format");
        }

        return array_filter($matches, function ($key) {
            return is_string($key);
        }, ARRAY_FILTER_USE_KEY);
    }




    /**
     * @param array $params
     *
     * @return array
     *
     * @throws InvalidSignatureException
    */
    private function getPayloadFromParams(array $params): array
    {
        $signature = $this->makeSignature($params['header'], $params['payload']);

        $signature_from_token = $this->decodeUrl($params["signature"]);

        if (! hash_equals($signature, $signature_from_token)) {
            throw new InvalidSignatureException("signature doesn't match");
        }

        return $this->decodeUrlFromJson($params["payload"]);
    }
}