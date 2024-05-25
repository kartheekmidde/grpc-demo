const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync('../proto/cricket.proto')
const grpcObject = grpc.packageDefinition(packageDefinition)
const cricketProto = grpcObject.CricketService

const address = '0.0.0.0:50051'
const client = new cricketProto(address, grpc.credentials.createInsecure())