<?php
namespace Laventure\Component\Security\Jwt\Encoder;

use Laventure\Component\Security\Encoder\Traits\Base64UrlEncoder;

/**
 * @JwtEncoder
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
    */
    public function decode(string $string): array
    {

    }





    /**
     * @return string
    */
    private function encodeJwtHeaders(): string
    {
        return $this->encodeUrlFromArray([
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
        return $this->encodeUrlFromArray($payload);
    }




    /**
     * @param string $encodedHeaders
     *
     * @param string $encodedPayload
     *
     * @return string
    */
    private function encodeSignature(string $encodedHeaders, string $encodedPayload): string
    {
         $format = sprintf('%s.%s.%s', $encodedHeaders, $encodedPayload, $this->secretKey);

         $signature = hash_hmac("sha256", $format, true);

         return $this->encodeUrl($signature);
    }
}