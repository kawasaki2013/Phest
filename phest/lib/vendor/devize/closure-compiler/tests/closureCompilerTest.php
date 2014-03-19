<?php

use Devize\ClosureCompiler\ClosureCompiler;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-05-09 at 16:25:31.
 */
class closureCompilerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClosureCompiler
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ClosureCompiler;
        #$this->root = vfsStream::setup('tmp');
        vfsStream::setup('tmp');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::getBinary
     * @covers Devize\ClosureCompiler\ClosureCompiler::__construct
     */
    public function testGetBinary()
    {
        $result = $this->object->getBinary();
        $this->assertNotEmpty($result);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::getConfig
     */
    public function testGetConfig()
    {
        $result = $this->object->getConfig();
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setSourceBaseDir
     */
    public function testSetSourceBaseDir1()
    {
        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $result = $this->object->getConfig();
        $this->assertEquals($dir . '/', $result['sourceBaseDir']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setSourceBaseDir
     */
    public function testSetSourceBaseDir2()
    {
        $this->object->setSourceBaseDir();
        $result = $this->object->getConfig();
        $this->assertEquals('', $result['sourceBaseDir']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setSourceBaseDir
     * @expectedException Devize\ClosureCompiler\CompilerException
     * @expectedExceptionMessage The path 'non-existent-path' does not seem to exist.
     */
    public function testSetSourceBaseDir3()
    {
        $this->object->setSourceBaseDir('non-existent-path');
    }


    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setTargetBaseDir
     */
    public function testSetTargetBaseDir1()
    {
        $dir = vfsStream::url('tmp');
        $this->object->setTargetBaseDir($dir);
        $result = $this->object->getConfig();
        $this->assertEquals($dir . '/', $result['targetBaseDir']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setTargetBaseDir
     */
    public function testSetTargetBaseDir2()
    {
        $this->object->setTargetBaseDir();
        $result = $this->object->getConfig();
        $this->assertEquals('', $result['targetBaseDir']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setTargetBaseDir
     * @expectedException Devize\ClosureCompiler\CompilerException
     * @expectedExceptionMessage The path 'non-existent-path' does not seem to exist.
     */
    public function testSetTargetBaseDir3()
    {
        $this->object->setTargetBaseDir('non-existent-path');
    }


    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::clearSourceFiles
     */
    public function testClearSourceFiles()
    {
        $this->object->clearSourceFiles();
        $result = $this->object->getConfig();
        $this->assertEmpty($result['sourceFileNames']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::addSourceFile
     */
    public function testAddSourceFile1()
    {
        #vfsStream::setup('tmp/test.js');
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->addSourceFile('test.js');
        $result = $this->object->getConfig();
        $this->assertNotEmpty($result['sourceFileNames']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::addSourceFile
     */
    public function testAddSourceFile2()
    {
        #vfsStream::setup('tmp/test.js');
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->addSourceFile('test.js');
        $this->object->addSourceFile('test.js'); # duplicate file name
        $result = $this->object->getConfig();
        $this->assertEquals(1,count($result['sourceFileNames']));
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::addSourceFile
     * @expectedException Devize\ClosureCompiler\CompilerException
     * @expectedExceptionMessage The path 'vfs://tmp/test.js' does not seem to exist.
     */
    public function testAddSourceFile3()
    {
        #vfsStream::setup('tmp/test.js');

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->addSourceFile('test.js');
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setSourceFiles
     */
    public function testSetSourceFiles()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test1.js'));
        $root->addChild(vfsStream::newFile('test2.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->setSourceFiles(array('test1.js', 'test2.js'));
        $result = $this->object->getConfig();
        $this->assertNotEmpty($result['sourceFileNames']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::removeSourceFile
     */
    public function testRemoveSourceFile()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->setSourceFiles(array('test.js'));
        $this->object->removeSourceFile('test.js');
        $result = $this->object->getConfig();
        $this->assertEmpty($result['sourceFileNames']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setTargetFile
     */
    public function testSetTargetFile1()
    {
        $this->object->setTargetFile('test.js');
        $result = $this->object->getConfig();
        $this->assertEquals($result['targetBaseDir'] . 'test.js', $result['targetFileName']);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::setTargetFile
     */
    public function testSetTargetFile2()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setTargetBaseDir($dir);
        $this->object->setTargetFile('test.js');

    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::compile
     * @expectedException Devize\ClosureCompiler\CompilerException
     * @expectedExceptionMessage The target file 'vfs://tmp/test.js' is one of the source files. A compile would cause undesired effects.
     */
    public function testCompile1()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->setSourceFiles(array('test.js'));

        $this->object->setTargetBaseDir($dir);
        $this->object->setTargetFile('test.js');
        $result = $this->object->compile();
        $this->assertEquals(1, $result);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::compile
     */
    public function testCompile2()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->setSourceFiles(array('test.js'));
        $result = $this->object->compile();
        $this->assertEquals(1, $result);
    }

    /**
     * @covers Devize\ClosureCompiler\ClosureCompiler::compile
     */
    public function testCompile3()
    {
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(vfsStream::newFile('test.js'));
        $root->addChild(vfsStream::newFile('compiled.js'));

        $dir = vfsStream::url('tmp');
        $this->object->setSourceBaseDir($dir);
        $this->object->setSourceFiles(array('test.js'));
        $this->object->setTargetBaseDir($dir);
        $result = $this->object->compile();
        $result = $this->object->getConfig();
        $this->assertEquals('vfs://tmp/compiled.js', $result['targetFileName']);
    }
}
