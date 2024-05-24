const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync("./proto/cricket.proto")
const grpcObject = grpc.loadPackageDefinition(packageDefinition)
const cricketProto = grpcObject.CricketService

import { getMatchResult, getLiveScore, updatePlayerStats, chat } from "./services/cricket_service"

const server = new grpc.Server()

server.addService(cricketPackage.service, {
    GetMatchResult: getMatchResult,
    GetLiveScore: getLiveScore,
    UpdatePlayerStats: updatePlayerStats,
    Chat: chat,
})

const address = '0.0.0.0:500051'

server.bindAsync(address, grpc.ServerCredentials.createInsecure(), (err, port) => {
    if (error) {
        console.log(`Server error ${error}`)
        return;
    }
    console.log(`Server running at ${address}`)
    server.start()
})