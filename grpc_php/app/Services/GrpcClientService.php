<?php

namespace App\Services;

use Grpc\ChannelCredentials;
use App\Grpc\CricketPackage\CricketServiceClient;
use App\Grpc\CricketPackage\MatchRequest;

class GrpcClientService
{
    protected $client;

    public function __construct()
    {
        $this->client = new CricketServiceClient('0.0.0.0:50051', [
            'credentials' => ChannelCredentials::createInsecure(), 
        ]);
    }

    public function getMatchResult($matchId)
    {
        $request = new MatchRequest();
        $request->setMatchId($matchId);

        list($response, $status) = $this->client->GetMatchResult($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            throw new \Exception("gRPC call failed with status code: {$status->code}");
        }

        return $response;
    }
}