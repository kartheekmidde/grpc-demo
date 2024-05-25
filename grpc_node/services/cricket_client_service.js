
function getMatchResult(client, matchId) {
    console.log('---- Fetching match result ----' + matchId)
    const req = {
        match_id: matchId
    }
    client.GetMatchResult(req, (err, resp) => {
        if (!err)
            console.log('Match result: ', resp)
        else
            console.log(err)
    })
}

function getLiveScore(client, id) {
    console.log('---- Getting live scores ----')
    const req = {
        match_id: id
    }
    // Get the stream from the server
    const call = client.GetLiveScore(req)

    // Get the actual data from the stream
    call.on('data', (score) => {
        console.log("Received live score: ", score)
    })

    // On stream close call from the server
    call.on('end', () => {
        // console.log("End of live score updates")
    })
}

function updatePlayerStats(client, playerStats) {
    console.log('---- Updating player stats ----')
    // Create a stream and define how to handle the final resp from the server
    const call = client.UpdatePlayerStats((err, resp) => {
        // no error in processing the request
        if (!err)
            console.log('Stats summary: ', resp)
        else
            console.error(err)
    })

    // Send actual data through the stream
    playerStats.forEach((stat, index) => {
        setTimeout(() => {
            console.log('Sending player info: ' + index)
            call.write(stat)
        }, index * 2000)
    })

    setTimeout(() => {
        call.end()
    }, playerStats.length * 2000)
}

function chat(client, messages) {
    console.log('---- Chat started ----')
    // Create a stream with the server
    const call = client.Chat()

    // Receive messages from the server stream
    call.on('data', (chatMessage) => {
        console.log(`[${chatMessage.timestamp}] ${chatMessage.user_id}: ${chatMessage.message}`)
    })

    // End server stream
    call.on('end', () => {
        console.log("End of chat")
    })

    // Send messages in client stream
    messages.forEach((message, index) => {
        setTimeout(() => {
            console.log(`[${message.timestamp}] ${message.user_id}: ${message.message}`)
            call.write(message)
        }, index * 2000)
    })

    // End client stream
    setTimeout(() => {
        call.end()
    }, messages.length * 2000)
}

module.exports = { getMatchResult, getLiveScore, updatePlayerStats, chat }