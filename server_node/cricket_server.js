const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync("./proto/cricket.proto")
const grpcObject = grpc.loadPackageDefinition(packageDefinition)
const cricketProto = grpcObject.CricketService

import { getMatchResult, getLiveScore, updatePlayerStats, chat } from "./services/cricket_service"

const server = new grpc.Server()

server.addService(cricketProto.service, {
    GetMatchResult: getMatchResult,
    GetLiveScore: getLiveScore,
    UpdatePlayerStats: updatePlayerStats,
    Chat: chat,
})

const address = '0.0.0.0:50051'

server.bindAsync(address, grpc.ServerCredentials.createInsecure(), (err, port) => {
    if (err) {
        console.log(`Server error ${err}`)
        return;
    }
    console.log(`Server running at ${address}`)
    server.start()
})