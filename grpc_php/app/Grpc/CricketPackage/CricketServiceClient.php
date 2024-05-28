<?php
// GENERATED CODE -- DO NOT EDIT!

namespace App\Grpc\CricketPackage;

/**
 */
class CricketServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Unary
     * @param \App\Grpc\CricketPackage\MatchRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetMatchResult(\App\Grpc\CricketPackage\MatchRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cricketPackage.CricketService/GetMatchResult',
        $argument,
        ['\App\Grpc\CricketPackage\MatchResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Server Streaming
     * @param \App\Grpc\CricketPackage\MatchRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\ServerStreamingCall
     */
    public function GetLiveScore(\App\Grpc\CricketPackage\MatchRequest $argument,
      $metadata = [], $options = []) {
        return $this->_serverStreamRequest('/cricketPackage.CricketService/GetLiveScore',
        $argument,
        ['\App\Grpc\CricketPackage\MatchScore', 'decode'],
        $metadata, $options);
    }

    /**
     * Client Streaming
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\ClientStreamingCall
     */
    public function UpdatePlayerStats($metadata = [], $options = []) {
        return $this->_clientStreamRequest('/cricketPackage.CricketService/UpdatePlayerStats',
        ['\App\Grpc\CricketPackage\StatsSummary','decode'],
        $metadata, $options);
    }

    /**
     * Bidirectional Streaming
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\BidiStreamingCall
     */
    public function Chat($metadata = [], $options = []) {
        return $this->_bidiRequest('/cricketPackage.CricketService/Chat',
        ['\App\Grpc\CricketPackage\ChatMessage','decode'],
        $metadata, $options);
    }

}
