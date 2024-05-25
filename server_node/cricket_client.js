const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync('./proto/cricket.proto', {
    keepCase: true,
    longs: String,
    enums: String,
    defaults: true,
    oneofs: true
})
const protoDescriptor = grpc.loadPackageDefinition(packageDefinition)
const cricketProto = protoDescriptor.cricketPackage.CricketService

const { getMatchResult, getLiveScore, updatePlayerStats, chat } = require("./services/cricket_client_service")

const address = '0.0.0.0:50051'
const client = new cricketProto(address, grpc.credentials.createInsecure())

const playerStats = [
    { player_id: 1, name: 'Sunil Narine', runs: 482, wickets: 16 },
    { player_id: 2, name: 'Andre Russell', runs: 22, wickets: 16 },
    { player_id: 3, name: 'Pat Cummins', runs: 112, wickets: 17 },
]

const chatMessages = [
    { user_id: "Raina", message: "That was a beautiful cover drive", timestamp: new Date().toISOString() },
    { user_id: "Chopra", message: "One of the best today", timestamp: new Date().toISOString() },
    { user_id: "Sunny", message: "That brings up the timeout as well", timestamp: new Date().toISOString() },
]

getMatchResult(client, 1)

setTimeout(() => {
    getLiveScore(client, 1)
}, 1500)

setTimeout(() => {
    updatePlayerStats(client, playerStats)
}, 6500)

setTimeout(() => {
    chat(client, chatMessages)
}, 13000)

