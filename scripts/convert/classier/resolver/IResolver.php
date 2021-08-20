<?php

namespace script\convert\classier\resolver;

use Generator;
use script\convert\classier\model\PropertyModel;

interface IResolver
{

    /**
     * 获取实例
     * @param $paths
     * @return Generator
     */
    public static function getInstance($paths);

    /**
     * diff path
     * @return string
     */
    public function getDiffPath(): string;

    /**
     * file name
     * @return string
     */
    public function getFilename(): string;

    /**
     * class name
     * @return string
     */
    public function getClassName(): string;

    /**
     * short class name
     * @return string
     */
    public function getShortName(): string;

    /**
     * extends names
     * @return array|null
     */
    public function getExtendsNames(): ?array;

    /**
     * implements name
     * @return array|null
     */
    public function getImplementsNames(): ?array;

    /**
     * doc comment
     * @return string
     */
    public function getComment(): string;

    /**
     * 获取常量
     * @return PropertyModel[]
     */
    public function getConstants(): array;

    /**
     * 获取属性
     * @return PropertyModel[]
     */
    public function getProperties(): array;
}
