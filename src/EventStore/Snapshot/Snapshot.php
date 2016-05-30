<?php

namespace HelloFresh\Engine\EventStore\Snapshot;

use HelloFresh\Engine\Domain\AggregateIdInterface;
use HelloFresh\Engine\Domain\AggregateRootInterface;

class Snapshot
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var AggregateIdInterface
     */
    private $aggregateId;

    /**
     * @var AggregateRootInterface
     */
    private $aggregate;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * Snapshot constructor.
     * @param AggregateIdInterface $aggregateId
     * @param AggregateRootInterface $aggregate
     * @param string $version
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        AggregateIdInterface $aggregateId,
        AggregateRootInterface $aggregate,
        $version,
        \DateTimeImmutable $createdAt
    ) {
        $this->aggregateId = $aggregateId;
        $this->aggregate = $aggregate;
        $this->version = $version;
        $this->createdAt = $createdAt;
    }

    /**
     * Take a snapshot
     * @param AggregateIdInterface $aggregateId
     * @param AggregateRootInterface $aggregate
     * @param $version
     * @return static
     */
    public static function take(AggregateIdInterface $aggregateId, AggregateRootInterface $aggregate, $version)
    {
        return new static($aggregateId, $aggregate, $version, new \DateTimeImmutable());
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return AggregateRootInterface
     */
    public function getAggregate()
    {
        return $this->aggregate;
    }

    /**
     * @return AggregateIdInterface
     */
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return get_class($this->aggregate);
    }
}