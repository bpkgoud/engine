<?php

namespace HelloFresh\Engine\Domain;

/**
 * Represents an important change in the domain.
 */
final class DomainMessage
{
    /**
     * @var DomainEventInterface
     */
    private $payload;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \DateTimeImmutable
     */
    private $recordedOn;

    /**
     * @var int
     */
    private $version;

    /**
     * @param string $id
     * @param $version
     * @param mixed $payload
     * @param \DateTimeImmutable $recordedOn
     */
    public function __construct($id, $version, $payload, \DateTimeImmutable $recordedOn)
    {
        $this->id = $id;
        $this->payload = $payload;
        $this->recordedOn = $recordedOn;
        $this->version = $version;
    }

    /**
     * @return AggregateIdInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DomainEventInterface
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecordedOn()
    {
        return $this->recordedOn;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return get_class($this->payload);
    }

    /**
     * @param string $id
     * @param $version
     * @param DomainEventInterface $payload
     * @return DomainMessage
     */
    public static function recordNow($id, $version, DomainEventInterface $payload)
    {
        return new DomainMessage($id, $version, $payload, new \DateTimeImmutable('now', new \DateTimeZone('UTC')));
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}
