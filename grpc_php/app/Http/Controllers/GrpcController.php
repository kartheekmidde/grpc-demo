<?php

namespace App\Http\Controllers;

use App\Services\GrpcClientService;

class GrpcController extends Controller 
{
    protected $grpcClientService;
    
    public function __construct(GrpcClientService $grpcClientService)
    {
        $this->grpcClientService = $grpcClientService;   
    }

    public function getMatchResult($matchId)
    {
        try {
            $result = $this->grpcClientService->getMatchResult($matchId);
            return response()->json([
               'team1' => $result->getTeam1(),
               'team2' => $result->getTeam2(),
               'result' => $result->getResult(),
            ]);
        } catch (\Exception $e) {
            return response()->json([ 'error' => $e->getMessage()], 500);
        }
    }
}