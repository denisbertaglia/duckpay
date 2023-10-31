<?php

namespace Tests\Unit\Application;

use App\Application\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function test_pagination(): void
    {
        $pagination = new Pagination();
        $this->assertEquals(0,$pagination->getOffset());
        $this->assertEquals(10,$pagination->getLimit());
    }
    /**
     * @param $page
     * @param $pageSize
     * @param $offset
     * @param $limit
     * @return void
     * @dataProvider data_provider_pagination
     */
    public function test_pagination_bunk($page, $pageSize, $offset, $limit): void
    {
        $pagination = new Pagination($page, $pageSize);
        $this->assertEquals($offset, $pagination->getOffset());
        $this->assertEquals($limit, $pagination->getLimit());
    }
    public static function data_provider_pagination(): array{
        return [
            'First page' => [1,10,0,10],
            'Second page' => [2,10,10,10],
            'Third page' => [3,10,20,10],
        ];
    }
}
