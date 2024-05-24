const grpc = require("@grpc/grpc-js")
const protoLoader = require("@grpc/proto-loader")

const packageDefinition = protoLoader.loadSync("./proto.cricket.proto")
const grpcObject = grpc.loadPackageDefinition(packageDefinition)

const cricketPackage = grpcObject.Cricket

const server = new grpc.Server()
