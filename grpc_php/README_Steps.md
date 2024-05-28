# Set up

## Base set up
- Install these if not already installed
    - homebrew - `/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`
    - PHP - `brew install php`
    - Composer - `brew install composer`
    - MySQL (if needed) - `brew install mysql` and to start `brew services start mysql` and to secure - `mysql_secure_installation`

## New Project Creation
- Create a new laravel project `laravel new proj-name`
- To set up environmen, copy .env.example to .env
- Generate an application key `php artisan key:generate`
- Serve the application `php artisan key:generate`

## gRPC Client packages and extensions
### General
- Install gRPC php extension - `sudo pecl install grpc`
- Install protobuf extension - `sudo pecl install protobuf`. Make sure that there are no errors.
- To check the installation of these two files, hit
    - `php -m | grep grpc`
    - `php -m | grep protobuf`
- Add to `php.ini` if this does not get added - `extension=grpc.so` 
    - Move grpc.so and protobuf.so where required (if necessary)
        - `sudo mv /usr/local/Cellar/php/8.3.7/pecl/20230831/grpc.so /usr/local/lib/php/pecl/20230831/grpc.so` 
        - `sudo mv /usr/local/Cellar/php/8.3.7/pecl/20230831/protobuf.so /usr/local/lib/php/pecl/20230831/protobuf.so`
    - Make symlink (if necessary)
        - `sudo ln -s /usr/local/Cellar/php/8.3.7/pecl/20230831/grpc.so /usr/local/lib/php/pecl/20230831/grpc.so`
        - `sudo ln -s /usr/local/Cellar/php/8.3.7/pecl/20230831/protobuf.so /usr/local/lib/php/pecl/20230831/protobuf.so`

### Project steps (initial set up)
- Install gRPC library
    - `composer require grpc/grpc`
    - `composer require google/protobuf`-
- Create folders `Grpc` and `Protos` in app folder
- Save .proto files to app/Protos folder
- Fetch the path where the grpc_php_plugin is installed using `which grpc_php_plugin`. 
    - This is installed by homebrew - `brew install protobuf grpc` - to install and `ls /usr/local/bin/grpc_php_plugin` to check the path

- Generate the php classes from proto file
    - `protoc --proto_path=app/Protos --php_out=app/Grpc --grpc_out=app/Grpc --plugin=protoc-gen-grpc=`replace the path from above here` app/Protos/cricket.proto`
- Create the gRPC client service
    - Run `php artisan make:service GrpcClientService`
