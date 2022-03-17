<?php

namespace App\Test;

use App\Context\Context;
use App\Context\ContextInterface;
use App\Database\Query\Builder\QueryBuilderInterface;
use App\Database\Query\Builder\QueryBuilderStrategy;
use App\Database\Query\QueryService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class QueryServiceTest extends TestCase
{
    const BLOG_CONTEXT_STUB = [
        "id",
        "title",
        "description",
        "content_1",
        "content_2",
        "content_3",
        "content_4",
        "meta",
        "created_at",
        "updated_at"
    ];

    public function testBuild()
    {
        $expectedResult = 'SELECT COUNT(id) FROM blogs';
        $countQueryBuilder = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $countQueryBuilder->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();

        $contextMock
            ->method('offsetGet')
            ->with('blogs')
            ->willReturn(self::BLOG_CONTEXT_STUB);

        $sut = new QueryService($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Count, 'blogs');
        $this->assertEquals($expectedResult, $actualResult);
    }
}