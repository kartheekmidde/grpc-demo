<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: cricket.proto

namespace App\Grpc\CricketPackage;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>cricketPackage.StatsSummary</code>
 */
class StatsSummary extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 total_runs_scored = 1;</code>
     */
    protected $total_runs_scored = 0;
    /**
     * Generated from protobuf field <code>int32 total_wickets_taken = 2;</code>
     */
    protected $total_wickets_taken = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $total_runs_scored
     *     @type int $total_wickets_taken
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Cricket::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 total_runs_scored = 1;</code>
     * @return int
     */
    public function getTotalRunsScored()
    {
        return $this->total_runs_scored;
    }

    /**
     * Generated from protobuf field <code>int32 total_runs_scored = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setTotalRunsScored($var)
    {
        GPBUtil::checkInt32($var);
        $this->total_runs_scored = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 total_wickets_taken = 2;</code>
     * @return int
     */
    public function getTotalWicketsTaken()
    {
        return $this->total_wickets_taken;
    }

    /**
     * Generated from protobuf field <code>int32 total_wickets_taken = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setTotalWicketsTaken($var)
    {
        GPBUtil::checkInt32($var);
        $this->total_wickets_taken = $var;

        return $this;
    }

}

