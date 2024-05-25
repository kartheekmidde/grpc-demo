const grpc = require('@grpc/grpc-js');

const matchDetails = {
    1: { 
        match_id: 1, 
        team1: "RCB", 
        team2: "CSK", 
        result: "CSK won by 6 wickets" 
    },
    2: { 
        match_id: 2, 
        team1: "DC", 
        team2: "PBKS", 
        result: "PBKS won by 4 wickets" 
    },
    3: { 
        match_id: 3, 
        team1: "KKR", 
        team2: "SRH", 
        result: "KKR won by 4 runs" 
    },
};

function getMatchResult(call, callback) {
    console.log('---- Sending match result ----')
    const match = matchDetails[call.request.match_id]
    if (match){
        console.log('Match result: ', match)
        callback(null, match)
    } else {
        callback({
            code: grpc.status.NOT_FOUND,
            details: 'Match not found'
        })
    }
}

function getLiveScore(call) {
    console.log('---- Sending live scores ----')
    const scores = [
        { score: 'Team RR, 1/13', timestamp: "6:15 pm" },
        { score: 'Team RR, 2/49', timestamp: "6:30 pm" },
        { score: 'Team RR, 3/142', timestamp: "7:00 pm" },
    ];

    scores.forEach((score, index) => {
        setTimeout(() => {
            call.write(score)
            console.log('Sent live score: ', index)
        }, index * 2000)
    })

    setTimeout(() => {
        call.end()
    }, scores.length * 2000)
}

function updatePlayerStats(call, callback) {
    console.log('---- Updating player stats ----')
    let totalRuns = 0
    let totalWickets = 0

    let index = 0
    call.on('data', (playerStat) => {
        console.log('Received player stat: ', index++)
        totalRuns += playerStat.runs
        totalWickets += playerStat.wickets
    })

    call.on('end', () => {
        const resp = { 
            total_runs_scored: totalRuns,
            total_wickets_taken: totalWickets
        }
        console.log('Stats summary: ', resp)
        callback(null, resp)
    })
}

function chat(call) {
    console.log('---- Chat started ----')
    call.on('data', (chatMessage) => {
        console.log(`[${chatMessage.timestamp}] ${chatMessage.user_id}: ${chatMessage.message}`)
        const resp = { 
            user_id: "Server",
            message: `Received your message ${chatMessage.user_id}`,
            timestamp: new Date().toISOString()
        }
        call.write(resp)
        console.log(`[${resp.timestamp}] ${resp.user_id}: ${resp.message}`)
    })

    call.on('end', () => {
        call.end();
        console.log('End of chat')
    })
}

module.exports = { getMatchResult, getLiveScore, updatePlayerStats, chat }