<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use UnexpectedValueException;

class EnumTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testToArray_ReturnEnumsAsArray(): void {
        $r = EnumConcrete::toArray();

        $this->assertArrayHasKey('INIT', $r);
        $this->assertArrayHasKey('SUCC', $r);
        $this->assertArrayHasKey('FAIL', $r);
    }

    /**
     * @throws ReflectionException
     */
    public function testIsValid_WhenValueIsNotDefined_ReturnFalse(): void {
        $r = EnumConcrete::isValid('xxx');

        $this->assertFalse($r);
    }

    /**
     * @throws ReflectionException
     */
    public function testIsValid_WhenValueIsDefined_ReturnTrue(): void {
        $r = EnumConcrete::isValid('init');

        $this->assertTrue($r);
    }

    public function testGetEnumByCallingStaticMethod(): void {
        $r = EnumConcrete::INIT();

        $this->assertInstanceOf(Enum::class, $r);
    }

    public function testCallStatic_WhenValueNotDefined_ThrowBadMethodCallException(): void {

        $this->expectException(BadMethodCallException::class);

        EnumConcrete::NOT_DEFINED();
    }

    public function testGetValue_ReturnValueSetFromConstruct(): void {
        $enum = new EnumConcrete('init');

        $this->assertEquals('init', $enum->getValue());
    }

    public function testConstruct_WhenValueNotDefined_ThrowUnexpectedValueException(): void {

        $this->expectException(UnexpectedValueException::class);

        new EnumConcrete('xxx');
    }
}

/**
 * @method static EnumConcrete INIT()
 * @method static EnumConcrete SUCC()
 * @method static EnumConcrete FAIL()
 */
class EnumConcrete extends Enum
{
    private const INIT = 'init';
    private const SUCC = 'succ';
    private const FAIL = 'fail';
}