<?php

namespace Neutron\TemporaryFilesystem\Tests;

use Neutron\TemporaryFilesystem\IOException;
use Neutron\TemporaryFilesystem\TemporaryFilesystem;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class TemporaryFilesystemTest extends TestCase
{
    /**
     * @var string $workspace
     */
    private $workspace = null;

    /**
     * @var TemporaryFilesystem
     */
    private $filesystem;

    public function setUp()
    {
        parent::setUp();

        $this->workspace = sys_get_temp_dir().DIRECTORY_SEPARATOR.time().rand(0, 1000);
        mkdir($this->workspace, 0777, true);
        $this->workspace = realpath($this->workspace);
        $this->filesystem = TemporaryFilesystem::create();
    }

    public function tearDown()
    {
        $this->clean($this->workspace);
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Neutron\TemporaryFilesystem\TemporaryFilesystem', TemporaryFilesystem::create());
    }

    public function testConctruct()
    {
        $this->assertInstanceOf('Neutron\TemporaryFilesystem\TemporaryFilesystem', new TemporaryFilesystem(new Filesystem()));
    }

    /**
     * @param string $file
     */
    private function clean($file)
    {
        if (is_dir($file) && !is_link($file)) {
            $dir = new \FilesystemIterator($file);
            foreach ($dir as $childFile) {
                $this->clean($childFile);
            }

            rmdir($file);
        } else {
            unlink($file);
        }
    }

    /**
     * @dataProvider provideFilesToCreate
     */
    public function testCreateEmptyFile($prefix, $suffix, $extension, $maxTry, $pattern)
    {
        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'book-dir';
        mkdir($createDir);

        $file = $this->filesystem->createEmptyFile($createDir, $prefix, $suffix, $extension, $maxTry);
        $this->assertTrue(file_exists($file));
        $this->assertEquals($createDir, dirname($file));
        $this->assertEquals(0, filesize($file));
        $this->assertRegExp($pattern, basename($file));
        unlink($file);
    }

    public function testCreateTemporaryDir()
    {
        $dir = $this->filesystem->createTemporaryDirectory();
        $this->assertTrue(file_exists($dir));
        $this->assertTrue(is_dir($dir));
        rmdir($dir);
    }

    public function testCreateTemporaryDirWithPrefix()
    {
        $dir = $this->filesystem->createTemporaryDirectory(0777, 200, 'neutron');
        $this->assertTrue(file_exists($dir));
        $this->assertTrue(is_dir($dir));
        $this->assertStringContainsString('neutron', $dir);
        rmdir($dir);
    }

    public function provideFilesToCreate()
    {
        return array(
            array(null, null, null, 10, '/\w{5}/'),
            array('romain', null, null, 10, '/romain\w{5}/'),
            array(null, 'neutron', null, 10, '/\w{5}neutron/'),
            array(null, null, 'io', 10, '/\w{5}\.io/'),
            array('romain', null, 'io', 10, '/romain\w{5}\.io/'),
            array(null, 'neutron', 'io', 10, '/\w{5}neutron\.io/'),
            array('romain', 'neutron', 'io', 10, '/romain\w{5}neutron\.io/'),
        );
    }

    public function testCreateEmptyFileInvalidDir()
    {
        $this->expectException(IOException::class);

        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'invalid-book-dir';

        $this->filesystem->createEmptyFile($createDir);
    }

    public function testCreateEmptyFileInvalidDirSecondMethod()
    {
        $this->expectException(IOException::class);

        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'invalid-book-dir';

        $this->filesystem->createEmptyFile($createDir, 'romain', 'neutron');
    }

    public function testCreateEmptyFileFails()
    {
        $this->expectException(IOException::class);

        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'book-dir';
        mkdir($createDir);

        $this->filesystem->createEmptyFile($createDir, 'romain', 'neutron', null, 0);
    }

    public function testCreateEmptyFileOnFile()
    {
        $this->expectException(IOException::class);

        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'book-dir';
        touch($createDir);

        $this->filesystem->createEmptyFile($createDir, null, null, null);
    }

    public function testCreateEmptyFileOnFileSecondMethod()
    {
        $this->expectException(IOException::class);

        $createDir = $this->workspace . DIRECTORY_SEPARATOR . 'book-dir';
        touch($createDir);

        $this->filesystem->createEmptyFile($createDir, 'romain', 'neutron', 'io');
    }

    /**
     * @dataProvider provideFilesToCreate
     */
    public function testTemporaryFiles($prefix, $suffix, $extension, $maxTry, $pattern)
    {
        $files = $this->filesystem->createTemporaryFiles(3, $prefix, $suffix, $extension, $maxTry);
        $this->assertEquals(3, count($files));

        foreach ($files as $file) {
            $this->assertTrue(file_exists($file));
            $this->assertEquals(realpath(sys_get_temp_dir()), realpath(dirname($file)));
            $this->assertEquals(0, filesize($file));
            $this->assertRegExp($pattern, basename($file));
        }
    }

    /**
     * @dataProvider provideFilesToCreate
     */
    public function testTemporaryFile($prefix, $suffix, $extension, $maxTry, $pattern)
    {
        $file = $this->filesystem->createTemporaryFile($prefix, $suffix, $extension, $maxTry);
        $this->assertIsString($file);

        $this->assertTrue(file_exists($file));
        $this->assertEquals(realpath(sys_get_temp_dir()), realpath(dirname($file)));
        $this->assertEquals(0, filesize($file));
        $this->assertRegExp($pattern, basename($file));
    }

    public function testTemporaryFilesFails()
    {
        $this->expectException(IOException::class);

        $this->filesystem->createTemporaryFiles(3, 'prefix', 'suffix', null, 0);
    }

    public function testTemporaryFilesInvalidQuantity()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->filesystem->createTemporaryFiles(0);
    }
}
