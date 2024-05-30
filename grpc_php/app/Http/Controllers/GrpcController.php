<?php

namespace App\Http\Controllers;

use App\Services\GrpcClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

//    // To consolidate the stream as single response
//    public function getLiveScore(Request $request)
//    {
//        try {
//            Log::info('Getting live score');
//            $matchId = $request->input('match_id');
//            $response = $this->grpcClientService->getLiveScore($matchId);
//            return response()->json($response);
//        } catch (\Exception $e) {
//            return response()->json([ 'error' => $e->getMessage()], 500);
//        }
//    }

    // To handle stream as SSE
    public function getLiveScore(Request $request)
    {
        $matchId = $request->input('match_id');
        $status = 200;
        $headers = [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive'
        ];

        return response()->stream(function() use ($matchId) {
            Log::info('calling handle live score');
            $this->handleLiveScore($matchId);
        }, $status, $headers);
    }

    private function handleLiveScore($matchId)
    {
        try {
            $this->grpcClientService->getLiveScore($matchId, function ($score, $timestamp) {
                Log::info("data: " . json_encode(['score' => $score, 'timestamp' => $timestamp]));
            });
        } catch (\Exception $e) {
            Log::error('Error fetching live score: ' . $e->getMessage());
            echo "data: " . json_encode(['error' => 'Unable to fetch live score']);
        } finally {
            ob_flush();
            flush();
        }
    }
}
