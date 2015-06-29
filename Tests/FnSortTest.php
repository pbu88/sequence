<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 29/06/15
 * Time: 15:24
 */

namespace Revinate\SequenceBundle\Lib;

use \PHPUnit_Framework_TestCase;

class FnSortTest extends PHPUnit_Framework_TestCase {


    public function testFnComp() {
        $range = range(1, 100);
        $rangeReverse = array_reverse($range);

        // Check the values are sorted.
        $result = $rangeReverse;
        usort($result, FnSort::fnComp(FnGen::fnIdentity()));
        $this->assertEquals(range(1, 100), $result);
        $this->assertEquals($range, $result);
    }

    public function testFnRevComp() {
        $range = range(1, 100);
        $rangeReverse = array_reverse($range);

        // Check the values are sorted.
        $result = $range;
        usort($result, FnSort::fnRevComp(FnGen::fnIdentity()));
        $this->assertEquals($rangeReverse, $result);
    }

    public function testFnSort() {
        $range = range(1, 100);
        $rangeReverse = array_reverse($range);
        $fnSort = FnSort::fnSort();

        $this->assertEquals($range, $fnSort($rangeReverse));
        $this->assertNotEquals($rangeReverse, $fnSort($rangeReverse));
    }

    public function testFnSortBy() {
        $fnSortByName = FnSort::fnSortByField('name');
        $names = Sequence::make(TestData::$fruit)->pluck('name')->sort()->to_a();
        $results = Sequence::make($fnSortByName(TestData::$fruit))->pluck('name')->to_a();

        $this->assertEquals($names, $results);
    }

}
