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

export function getMatchResult(call, callback) {
    const match = matchDetails[call.request.match_id]
    if (match)
        callback(null, match)
    else {
        callback({
            code: grpc.status.NOT_FOUND,
            details: 'Match not found'
        })
    }
}

export function getLiveScore(call) {
    const scores = [
        { score: 'Team RR, 1/13', timestamp: "6:15 pm" },
        { score: 'Team RR, 2/49', timestamp: "6:30 pm" },
        { score: 'Team RR, 3/142', timestamp: "7:00 pm" },
    ];

    scores.forEach((score, index) => {
        setTimeout(() => {
            call.write(score)
        }, index * 2000)
    })

    setTimeout(() => {
        call.end()
    }, scores.length * 2000)
}

export function updatePlayerStats(call, callback) {
    let totalRuns = 0
    let totalWickets = 0

    call.on('data', (playerStat) => {
        totalRuns += playerStat.runs
        totalWickets += playerStat.wickets
    })

    call.on('end', () => {
        callback(null, { 
            total_runs_scored: totalRuns,
            total_wickets_taken: totalWickets
        })
    })
}

export function chat(call) {
    call.on('data', (chatMessage) => {
        console.log(`Received message from ${chatMessage.userid}: ${chatMessage.message}`)
        call.write({ 
            userid: 'Server',
            message: `Received your message ${chatMessage.message}`,
            timestamp: new Date().toISOString()
        })
    })

    call.on('end', () => {
        call.end();
    })
}

