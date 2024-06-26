<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: cricket.proto

namespace App\Grpc\CricketPackage;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>cricketPackage.PlayerStat</code>
 */
class PlayerStat extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     */
    protected $player_id = 0;
    /**
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>int32 runs = 3;</code>
     */
    protected $runs = 0;
    /**
     * Generated from protobuf field <code>int32 wickets = 4;</code>
     */
    protected $wickets = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $player_id
     *     @type string $name
     *     @type int $runs
     *     @type int $wickets
     * }
     */
    public function __construct($data = NULL) {
        \App\Grpc\GPBMetadata\Cricket::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     * @return int
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPlayerId($var)
    {
        GPBUtil::checkInt32($var);
        $this->player_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 runs = 3;</code>
     * @return int
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * Generated from protobuf field <code>int32 runs = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setRuns($var)
    {
        GPBUtil::checkInt32($var);
        $this->runs = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 wickets = 4;</code>
     * @return int
     */
    public function getWickets()
    {
        return $this->wickets;
    }

    /**
     * Generated from protobuf field <code>int32 wickets = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setWickets($var)
    {
        GPBUtil::checkInt32($var);
        $this->wickets = $var;

        return $this;
    }

}

