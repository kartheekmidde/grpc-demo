# Basics

Client Server setup using grpc/node

## Steps

1. Define .proto file from the server. Client should be made aware of the same data structure and service definitions.
2. Install protoc (Protocol Buffers Compiler)
3. Generate code for server using protoc. Implement the services defined in the .proto
4. Generate code for client using protoc
5. Import the genetaed code in 3 in server and use it encode outgoing messages and decode incoming messages
6. Import the genetaed code in 4 in client and use it encode outgoing messages and decode incoming messages

## Streams

0. Unary Service
   - Client sends a single request, server sends back a single response
1. Server Streaming
   - Client sends a single request, server sends back stream of responses
   - Ex: Client asks for updates, server keeps sending updates
2. Client Streaming
   - Client sends stream of requests, server sends a single response after receiving all requests
   - Ex: Large file uploaded in chunks by client, server confirms
3. Bidirectional Streaming
   - Both client and server send a stream of messages to each other
   - Ex: chat application

## Proto file format

- Defines the structure of the data and the services
- `syntax` - specifies the protobuf version
- `package` - specifies the namespace
- `message` - defines the data structures, similar to classes in oop
- `service` - defined the RPC services and methods for RPC

## Packages required

- `@grpc/grpc-js`
  - Provides the core gRPC functionality for Node
  - Used to create a gRPC server, define services and handle RPC calls
- `@grpc/proto-loader`
  - Loads .proto files and converts them into JS
  - Parses .proto files to generate the necessary service and message definitions used by @grpc/grpc-js

## Run the application

- Make sure `node` and `npm` are installed in your system
- Run `sudo npm i` in the folder where package.json is to install the node packages
- Hit `node cricket_server.js` on first terminal
- Hit `node cricket_client.js` on second terminal to see the messages interchanged using grpc
