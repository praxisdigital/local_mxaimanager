<?php
namespace local_mxaimanager\tests\unit;
defined('MOODLE_INTERNAL') || die();

class deprecation_compatibility_test extends \PHPUnit\Framework\TestCase
{
    public function test_iterator_boundaries_and_keys(): void
    {
        $empty = new \local_mxaimanager\app\collection([]);
        self::assertFalse($empty->valid());
        $data = [0 => 'zero', '' => 'empty key', 'nullable' => null];
        $collection = new \local_mxaimanager\app\collection($data);
        self::assertSame($data, iterator_to_array($collection));
        self::assertFalse($collection->valid());
        self::assertFalse($collection->valid());
        $collection->rewind();
        self::assertTrue($collection->valid());
    }
}
