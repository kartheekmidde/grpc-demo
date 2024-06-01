const { getLiveScore } = require("../../services/cricket_server_service")

describe('getLiveScore', () => {

    let call;

    beforeEach(() => {
        call = {
            write: jest.fn(),
            end: jest.fn()
        }
        jest.useFakeTimers()
    })

    afterEach(() => {
        jest.useRealTimers()
    })

    it('should return live score as stream', () => {
        getLiveScore(call)
        jest.advanceTimersByTime(6000)
        
        expect(call.write).toHaveBeenCalledTimes(3)
        expect(call.end).toHaveBeenCalled()
        call.write.mock.calls.forEach(callArg => {
            expect(callArg[0]).toHaveProperty('score')
            expect(callArg[0]).toHaveProperty('timestamp')
        })
    })
})