<?php

namespace App\Test;

use App\Context\ContextInterface;
use App\Database\Query\Builder\QueryBuilderInterface;
use App\Database\Query\Builder\QueryBuilderStrategy;
use App\Database\Query\QueryService;
use PHPUnit\Framework\TestCase;

class QueryServiceTest extends TestCase
{
    const BLOG_CONTEXT = [
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

    public function testCountQueryBuild()
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
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryService($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Count, 'blogs');
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testInsertQueryBuild()
    {
        $params = [
            'title' => 'test title',
            'description' => 'test description',
        ];
        $expectedResult = "INSERT INTO blogs(title, description) VALUES(:title, :description)";
        $insertQueryBuilderMock = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $insertQueryBuilderMock->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with('blogs')
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryService($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Insert, 'blogs', $params);
        $this->assertEquals($expectedResult, $actualResult);
    }
}
