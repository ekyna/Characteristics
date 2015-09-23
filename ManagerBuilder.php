<?php

namespace Ekyna\Component\Characteristics;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\FileCacheReader;
use Ekyna\Component\Characteristics\Builder\DefaultDriverFactory;
use Ekyna\Component\Characteristics\Schema\SchemaRegistry;
use Metadata\Cache\FileCache;
use Metadata\Driver\DriverInterface;
use Metadata\MetadataFactory;

/**
 * Class ManagerBuilder
 * @package Ekyna\Component\Characteristics
 */
class ManagerBuilder
{
    private $metadataDirs = [];
    private $schemaDirs = [];
    private $debug = false;
    private $cacheDir;
    private $annotationReader;
    private $includeInterfaceMetadata = true;
    private $driverFactory;

    public static function create()
    {
        return new static();
    }

    public function __construct()
    {
        $this->driverFactory = new DefaultDriverFactory();
    }

    /**
     * Sets the annotation reader.
     *
     * @param Reader $reader
     *
     * @return ManagerBuilder
     */
    public function setAnnotationReader(Reader $reader)
    {
        $this->annotationReader = $reader;

        return $this;
    }

    /**
     * Enables or disables the debug mode.
     *
     * @param $bool
     *
     * @return ManagerBuilder
     */
    public function setDebug($bool)
    {
        $this->debug = (bool)$bool;

        return $this;
    }

    /**
     * Sets the cache directory.
     *
     * @param $dir
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function setCacheDir($dir)
    {
        if (!is_dir($dir)) {
            $this->createDir($dir);
        }
        if (!is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('The cache directory "%s" is not writable.', $dir));
        }

        $this->cacheDir = $dir;

        return $this;
    }

    /**
     * @param Boolean $include Whether to include the metadata from the interfaces
     *
     * @return ManagerBuilder
     */
    public function includeInterfaceMetadata($include)
    {
        $this->includeInterfaceMetadata = (bool)$include;

        return $this;
    }

    /**
     * Sets metadata directories.
     *
     * @param array <string,string> $dirs
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException When a directory does not exist
     */
    public function setMetadataDirs(array $dirs)
    {
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
            }
        }

        $this->metadataDirs = $dirs;

        return $this;
    }

    /**
     * Adds a metadata directory.
     *
     * @param string $dir The directory where metadata files are located.
     * @param string $namespacePrefix An optional prefix if you only store metadata for specific namespaces in this directory.
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException When a directory does not exist
     * @throws \InvalidArgumentException When a directory has already been registered
     */
    public function addMetadataDir($dir, $namespacePrefix = '')
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
        }

        if (isset($this->metadataDirs[$namespacePrefix])) {
            throw new \InvalidArgumentException(sprintf('There is already a directory configured for the namespace prefix "%s". Please use replaceMetadataDir() to override directories.', $namespacePrefix));
        }

        $this->metadataDirs[$namespacePrefix] = $dir;

        return $this;
    }

    /**
     * Adds a map of namespace prefixes to directories.
     *
     * @param array <string,string> $namespacePrefixToDirMap
     *
     * @return ManagerBuilder
     */
    public function addMetadataDirs(array $namespacePrefixToDirMap)
    {
        foreach ($namespacePrefixToDirMap as $prefix => $dir) {
            $this->addMetadataDir($dir, $prefix);
        }

        return $this;
    }

    /**
     * Similar to addMetadataDir(), but overrides an existing entry.
     *
     * @param string $dir
     * @param string $namespacePrefix
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException When a directory does not exist
     * @throws \InvalidArgumentException When no directory is configured for the ns prefix
     */
    public function replaceMetadataDir($dir, $namespacePrefix = '')
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
        }

        if (!isset($this->metadataDirs[$namespacePrefix])) {
            throw new \InvalidArgumentException(sprintf('There is no directory configured for namespace prefix "%s". Please use addMetadataDir() for adding new directories.', $namespacePrefix));
        }

        $this->metadataDirs[$namespacePrefix] = $dir;

        return $this;
    }

    /**
     * Sets the schema directories.
     *
     * @param array $dirs
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function setSchemaDirs(array $dirs)
    {
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
            }
        }

        $this->schemaDirs = $dirs;

        return $this;
    }

    /**
     * Adds a schema directory.
     *
     * @param $dir
     *
     * @return ManagerBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function addSchemaDir($dir)
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
        }

        if (in_array($dir, $this->schemaDirs)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" is already configured.', $dir));
        }

        return $this;
    }

    /**
     * Adds some schema directories.
     *
     * @param array $dirs
     *
     * @return ManagerBuilder
     */
    public function addSchemaDirs(array $dirs)
    {
        foreach ($dirs as $dir) {
            $this->addSchemaDir($dir);
        }

        return $this;
    }

    /**
     * Builds and return a Manager instance.
     *
     * @return Manager
     */
    public function build()
    {
        $annotationReader = $this->annotationReader;
        if (null === $annotationReader) {
            $annotationReader = new AnnotationReader();

            if (null !== $this->cacheDir) {
                $this->createDir($this->cacheDir . '/annotations');
                $annotationReader = new FileCacheReader($annotationReader, $this->cacheDir . '/annotations', $this->debug);
            }
        }

        $metadataDriver = $this->driverFactory->createDriver($this->metadataDirs, $annotationReader);
        $metadataFactory = new MetadataFactory($metadataDriver);

        $metadataFactory->setIncludeInterfaces($this->includeInterfaceMetadata);

        if (null !== $this->cacheDir) {
            $this->createDir($this->cacheDir . '/metadata');
            $metadataFactory->setCache(new FileCache($this->cacheDir . '/metadata'));
        }

        $schemaRegistry = new SchemaRegistry($this->schemaDirs);

        // TODO registry caching

        return new Manager($metadataFactory, $schemaRegistry);
    }

    /**
     * Creates a directory.
     *
     * @param $dir
     * @throws \RuntimeException
     */
    private function createDir($dir)
    {
        if (is_dir($dir)) {
            return;
        }

        if (false === @mkdir($dir, 0777, true)) {
            throw new \RuntimeException(sprintf('Could not create directory "%s".', $dir));
        }
    }
}
