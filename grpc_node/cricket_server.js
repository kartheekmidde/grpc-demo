const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync("./proto/cricket.proto", {
    keepCase: true,
    longs: String,
    enums: String,
    defaults: true,
    oneofs: true
})
const protoDescriptor = grpc.loadPackageDefinition(packageDefinition)
const cricketProto = protoDescriptor.cricketPackage.CricketService

const { getMatchResult, getLiveScore, updatePlayerStats, chat } = require("./services/cricket_server_service")

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
})