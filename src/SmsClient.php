<?php 

namespace pyaesone17\SmsPoh;

use GuzzleHttp\Client;
use Exceptions\AuthorizationException;
use pyaesone17\SmsPoh\Exceptions\BadRequestException;
use GuzzleHttp\Exception\ClientException;
use Exception;

class SmsClient
{
    public function __construct($api, $token)
    {
        $this->api = $api;
        $this->token = $token;
        $this->guzzle = new Client();
    }

    public function send($payload)
    {
        try {        
            $endpoint = $this->getSendingApi();

            $response = $this->guzzle->request(
                'POST', $endpoint,[
                'headers' => [
                    'Authorization' => "Bearer {$this->token}"
                ],
                'json' => [
                    'message' => $payload['message'],
                    'to' => $payload['to'],
                    'test' => $payload['test']
                ]
            ]);

            $result = json_decode( $response->getBody()->getContents(),true);

            if (isset($payload['callback']) || $payload['callback'] !== null) {
                $this->fireCallback($payload['callback'], $result);
            }

            return $result;
        } catch (ClientException $e) {

            if($e->getCode()===401){
                throw new AuthorizationException(
                    "Authorization failed. Please provide correct token for SmsPoh in configuration file.",
                    401
                );
            } elseif ($e->getCode()===403) {
                throw new BadRequestException(
                    $e->getMessage(),
                    403
                );
            }
        }
    }

    public function fetchMessages($page)
    {
        try {        
            $endpoint = $this->getFetchingApi();

            $respond = $this->guzzle->request(
                'GET', $endpoint,[
                'headers' => [
                    'Authorization' => "Bearer {$this->token}"
                ],
                'query' => [
                    'page' => $page
                ]
            ]);

            $result = json_decode(
                $respond->getBody()->getContents(),
                true
            );

            return $result;
            
        } catch (ClientException $e) {

            // This catch http is repeated, later need to refactor
            if($e->getCode()===401){
                throw new AuthorizationException(
                    "Authorization failed. Please provide correct token for SmsPoh in configuration file.",
                    401
                );
            } elseif ($e->getCode()===403) {
                throw new BadRequestException(
                    $e->getMessage(),
                    403
                );
            }
        }
    }

    protected function fireCallback($callback, $result)
    {
        $callback = $callback;

        call_user_func_array(
            $callback, 
            $result
        );
    }

    protected function getSendingApi()
    {
        return $this->api.'/send';
    }

    protected function getFetchingApi()
    {
        return $this->api.'/messages';
    }
}