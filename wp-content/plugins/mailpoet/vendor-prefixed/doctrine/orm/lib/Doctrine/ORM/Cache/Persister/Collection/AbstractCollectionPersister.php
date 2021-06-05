<?php
 namespace MailPoetVendor\Doctrine\ORM\Cache\Persister\Collection; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\Common\Collections\Criteria; use MailPoetVendor\Doctrine\ORM\Cache\EntityCacheKey; use MailPoetVendor\Doctrine\ORM\Cache\CollectionCacheKey; use MailPoetVendor\Doctrine\ORM\Cache\Persister\Entity\CachedEntityPersister; use MailPoetVendor\Doctrine\ORM\Persisters\Collection\CollectionPersister; use MailPoetVendor\Doctrine\ORM\PersistentCollection; use MailPoetVendor\Doctrine\ORM\EntityManagerInterface; use MailPoetVendor\Doctrine\ORM\Cache\Region; use MailPoetVendor\Doctrine\Common\Util\ClassUtils; abstract class AbstractCollectionPersister implements \MailPoetVendor\Doctrine\ORM\Cache\Persister\Collection\CachedCollectionPersister { protected $uow; protected $metadataFactory; protected $persister; protected $sourceEntity; protected $targetEntity; protected $association; protected $queuedCache = []; protected $region; protected $regionName; protected $hydrator; protected $cacheLogger; public function __construct(\MailPoetVendor\Doctrine\ORM\Persisters\Collection\CollectionPersister $persister, \MailPoetVendor\Doctrine\ORM\Cache\Region $region, \MailPoetVendor\Doctrine\ORM\EntityManagerInterface $em, array $association) { $configuration = $em->getConfiguration(); $cacheConfig = $configuration->getSecondLevelCacheConfiguration(); $cacheFactory = $cacheConfig->getCacheFactory(); $this->region = $region; $this->persister = $persister; $this->association = $association; $this->regionName = $region->getName(); $this->uow = $em->getUnitOfWork(); $this->metadataFactory = $em->getMetadataFactory(); $this->cacheLogger = $cacheConfig->getCacheLogger(); $this->hydrator = $cacheFactory->buildCollectionHydrator($em, $association); $this->sourceEntity = $em->getClassMetadata($association['sourceEntity']); $this->targetEntity = $em->getClassMetadata($association['targetEntity']); } public function getCacheRegion() { return $this->region; } public function getSourceEntityMetadata() { return $this->sourceEntity; } public function getTargetEntityMetadata() { return $this->targetEntity; } public function loadCollectionCache(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, \MailPoetVendor\Doctrine\ORM\Cache\CollectionCacheKey $key) { if (($cache = $this->region->get($key)) === null) { return null; } if (($cache = $this->hydrator->loadCacheEntry($this->sourceEntity, $key, $cache, $collection)) === null) { return null; } return $cache; } public function storeCollectionCache(\MailPoetVendor\Doctrine\ORM\Cache\CollectionCacheKey $key, $elements) { $associationMapping = $this->sourceEntity->associationMappings[$key->association]; $targetPersister = $this->uow->getEntityPersister($this->targetEntity->rootEntityName); $targetRegion = $targetPersister->getCacheRegion(); $targetHydrator = $targetPersister->getEntityHydrator(); if (!(isset($associationMapping['indexBy']) && $associationMapping['indexBy'])) { $elements = \array_values(\is_array($elements) ? $elements : $elements->getValues()); } $entry = $this->hydrator->buildCacheEntry($this->targetEntity, $key, $elements); foreach ($entry->identifiers as $index => $entityKey) { if ($targetRegion->contains($entityKey)) { continue; } $class = $this->targetEntity; $className = \MailPoetVendor\Doctrine\Common\Util\ClassUtils::getClass($elements[$index]); if ($className !== $this->targetEntity->name) { $class = $this->metadataFactory->getMetadataFor($className); } $entity = $elements[$index]; $entityEntry = $targetHydrator->buildCacheEntry($class, $entityKey, $entity); $targetRegion->put($entityKey, $entityEntry); } $cached = $this->region->put($key, $entry); if ($this->cacheLogger && $cached) { $this->cacheLogger->collectionCachePut($this->regionName, $key); } } public function contains(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, $element) { return $this->persister->contains($collection, $element); } public function containsKey(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, $key) { return $this->persister->containsKey($collection, $key); } public function count(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection) { $ownerId = $this->uow->getEntityIdentifier($collection->getOwner()); $key = new \MailPoetVendor\Doctrine\ORM\Cache\CollectionCacheKey($this->sourceEntity->rootEntityName, $this->association['fieldName'], $ownerId); $entry = $this->region->get($key); if ($entry !== null) { return \count($entry->identifiers); } return $this->persister->count($collection); } public function get(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, $index) { return $this->persister->get($collection, $index); } public function slice(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, $offset, $length = null) { return $this->persister->slice($collection, $offset, $length); } public function loadCriteria(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection, \MailPoetVendor\Doctrine\Common\Collections\Criteria $criteria) { return $this->persister->loadCriteria($collection, $criteria); } protected function evictCollectionCache(\MailPoetVendor\Doctrine\ORM\PersistentCollection $collection) { $key = new \MailPoetVendor\Doctrine\ORM\Cache\CollectionCacheKey($this->sourceEntity->rootEntityName, $this->association['fieldName'], $this->uow->getEntityIdentifier($collection->getOwner())); $this->region->evict($key); if ($this->cacheLogger) { $this->cacheLogger->collectionCachePut($this->regionName, $key); } } protected function evictElementCache($targetEntity, $element) { $targetPersister = $this->uow->getEntityPersister($targetEntity); $targetRegion = $targetPersister->getCacheRegion(); $key = new \MailPoetVendor\Doctrine\ORM\Cache\EntityCacheKey($targetEntity, $this->uow->getEntityIdentifier($element)); $targetRegion->evict($key); if ($this->cacheLogger) { $this->cacheLogger->entityCachePut($targetRegion->getName(), $key); } } } 