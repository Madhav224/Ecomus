const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const axios = require('axios');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

const dotenv = require('dotenv').config();

const LaraServerUrl = process.env.APP_URL;

const ExternalSocketUrl = 'https://thedatamining.org:6003';

// External Socket For Market Data
const externalSocket  = require('socket.io-client')(ExternalSocketUrl,{ rejectUnauthorized:   false,});

var all_stock_array = ['NIFTY-I', 'BANKNIFTY-I'];

all_stock_array.forEach(function($val) {
        // Emit the 'addMarketWatch' event with the specified data
    externalSocket.emit('addMarketWatch', {
        product: $val
    });
});

const BackgroundSocket  = require('socket.io-client')(ExternalSocketUrl,{ rejectUnauthorized:   false,});

BackgroundSocket.on('marketWatch', (Marketdata) => {    
    axios.post(LaraServerUrl+'execute-pending-trade',Marketdata)
    .then(response => {
        console.log('Background executePendingTrade Response', Marketdata,response.data);
    }).catch(error => {
        console.error('Error executing pending trade:', error);
    });
    // console.log('Background Market Watch', Marketdata);
    // io.to(socketId).emit('updateData', Marketdata);
});


// externalSocket.emit('addMarketWatch', {
//     product: all_stock_array
// });

// console.log(LaraServerUrl+'helper/get-trading-extensions');

// Optionally, you can also send the data to the Laravel application using HTTP request
// axios.get(LaraServerUrl+'helper/get-trading-extensions')
// .then(response => {
//     stock_array = response.data;

//     externalSocket.emit('addMarketWatch', {
//         product: stock_array
//     });
//     // stock_array.forEach(function($val) {
//     //     // Emit the 'addMarketWatch' event with the specified data
//     //     externalSocket.emit('addMarketWatch', {
//     //         product: $val
//     //     });
//     // });

//     console.log('Data sent to Laravel:', response.data);
// })
// .catch(error => {
//     console.error('Error sending data to Laravel:', error);
// });

var userWatchList = [];
var userGetLivePriceList = [];
var BackgroundExtension = [];

// Listen for data from the external socket.io server
externalSocket.on('marketWatch', (Marketdata) => {     
    // Broadcast the data to all connected clients
    io.emit('updateData', Marketdata);
    // console.log('Received data from external server:', Marketdata);
});

// Socket.IO for laravel
io.on('connection', (socket) => {

    userWatchList[socket.id] = require('socket.io-client')(ExternalSocketUrl,{ rejectUnauthorized:   false,});
    userGetLivePriceList[socket.id] = require('socket.io-client')(ExternalSocketUrl,{ rejectUnauthorized:   false,});

    console.log('A user connected',socket.id);
    var socketId = socket.id;

    // Listen for data from the client
    socket.on('updateData', (stock_array) => {
        console.log('Received data from client:', stock_array);
        var mystock = [...all_stock_array, ...stock_array?.product];
        mystock?.forEach(function($val) {
            // Emit the 'addMarketWatch' event with the specified data
            userWatchList[socket.id].emit('addMarketWatch', {
                product: $val
            });
        });
    });   
    userWatchList[socket.id].on('marketWatch', (Marketdata) => {    
        // Broadcast the data to all connected clients
        io.to(socketId).emit('updateData', Marketdata);
    });
    userWatchList[socket.id].on('disconnect', () => {
        delete userWatchList[socket.id];
        console.log('userWatchList User disconnected : ',socket.id);
    });


    // Listen for data from the client for live price one timw
    socket.on('getLivePriceData', (extension) => {
        console.log('Received data from getLivePriceData:', extension);
        var myextension = extension?.product;
        myextension?.forEach(function($val) {
            // Emit the 'addMarketWatch' event with the specified data
            userGetLivePriceList[socket.id].emit('addMarketWatch', {
                product: $val
            });
        });
    });
    userGetLivePriceList[socket.id].on('marketWatch', (Marketdata) => {     
        io.to(socketId).emit('getLivePriceData', Marketdata);
        userGetLivePriceList[socket.id].disconnect();
    });
    userGetLivePriceList[socket.id].on('disconnect', () => {
        delete userGetLivePriceList[socket.id];
        console.log('userGetLivePriceList User disconnected : ',socket.id);
    });



    // Listen for data from the client
    socket.on('addToBackground', (bkextension) => {
        console.log('Received data from getLivePriceData:', bkextension);
        var bkextension = bkextension?.product;
       
        bkextension?.forEach(function($val) {
            // Emit the 'addMarketWatch' event with the specified data
            BackgroundSocket.emit('addMarketWatch', {
                product: $val
            });
        });
        // BackgroundExtension = [...BackgroundExtension, ...bkextension];
        BackgroundExtension = [...new Set(bkextension)];        
        console.log('Background Process : '+BackgroundExtension);
    });


    userWatchList[socket.id].on('connect_error', (MarketError) => {
        console.error('Socket.IO connection error:', MarketError);
    });
    userWatchList[socket.id].on('error', (MarketError) => {
        console.error('Socket.IO error:', MarketError);
    });

    // Handle disconnection
    socket.on('disconnect', () => {
        // delete userWatchList[socket.id];
        console.log('User disconnected');
    });
});

// Start the server
const port = 3000;
server.listen(port, () => {
    console.log(`Server is listening on port ${port}`);
});