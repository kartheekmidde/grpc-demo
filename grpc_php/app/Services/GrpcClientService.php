<?php

namespace App\Services;

use Grpc\ChannelCredentials;
use App\Grpc\CricketPackage\CricketServiceClient;
use App\Grpc\CricketPackage\MatchRequest;
use Illuminate\Support\Facades\Log;

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

    // To consolidate the stream as single response
//    public function getLiveScore($matchId)
//    {
//        $request = new MatchRequest();
//        $request->setMatchId($matchId);
//
//        $call = $this->client->GetLiveScore($request);
//        $responses = [];
//
//        foreach ($call->responses() as $response){
//            $responses[] = [
//                'score' => $response->getScore(),
//                'timestamp' => $response->getTimestamp()
//            ];
//        }
//
//        return $responses;
//    }

    // To handle stream as SSE
    public function getLiveScore($matchId, $callback)
    {
        $request = new MatchRequest();
        $request->setMatchId($matchId);

        $call = $this->client->GetLiveScore($request);

        foreach ($call->responses() as $response) {
            $callback($response->getScore(), $response->getTimestamp());
        }
    }
}
