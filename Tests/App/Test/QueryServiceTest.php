<?php

namespace App\Test;

use App\Infrastructure\Context\ContextMapInterface;
use App\Infrastructure\Database\Domain\Query\QueryBuilderInterface;
use App\Infrastructure\Database\Infrastructure\Query\Builder\QueryBuilderStrategy;
use App\Infrastructure\Database\Infrastructure\Query\QueryBuilderHandler;
use App\Infrastructure\Service\BlogEntityService;
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
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();

        $contextMock
            ->method('offsetGet')
            ->with('blogs')
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
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
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with('blogs')
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Insert, BlogEntityService::BLOG_ENTITY_NAME, $params);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testUpdateQueryBuild()
    {
        $params = [
            'title' => 'test title',
            'description' => 'test description',
        ];
        $expectedResult = "UPDATE blogs SET title = :title, description = :description WHERE id = :id";
        $insertQueryBuilderMock = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $insertQueryBuilderMock->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with(BlogEntityService::BLOG_ENTITY_NAME)
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Update, BlogEntityService::BLOG_ENTITY_NAME, $params);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCatalogQueryBuild()
    {
        $expectedResult = "SELECT * FROM blogs";
        $insertQueryBuilderMock = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $insertQueryBuilderMock->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with(BlogEntityService::BLOG_ENTITY_NAME)
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Catalog, BlogEntityService::BLOG_ENTITY_NAME);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testPaginatedCatalogQueryBuild()
    {
        $expectedResult = "SELECT * FROM blogs LIMIT :limit OFFSET :offset";
        $insertQueryBuilderMock = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $insertQueryBuilderMock->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with(BlogEntityService::BLOG_ENTITY_NAME)
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::PaginatedCatalog, BlogEntityService::BLOG_ENTITY_NAME);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testShowQueryBuild()
    {
        $expectedResult = "SELECT * FROM blogs WHERE id = :id LIMIT 1";
        $insertQueryBuilderMock = $this
            ->getMockBuilder(QueryBuilderInterface::class)
            ->onlyMethods(['build'])
            ->getMock();
        $insertQueryBuilderMock->method('build')->willReturn($expectedResult);

        $contextMock = $this
            ->getMockBuilder(ContextMapInterface::class)
            ->onlyMethods(['offsetGet'])
            ->getMockForAbstractClass();
        $contextMock
            ->method('offsetGet')
            ->with(BlogEntityService::BLOG_ENTITY_NAME)
            ->willReturn(self::BLOG_CONTEXT);

        $sut = new QueryBuilderHandler($contextMock);
        $actualResult = $sut->createQuery(QueryBuilderStrategy::Show, BlogEntityService::BLOG_ENTITY_NAME, ['id' => 1]);
        $this->assertEquals($expectedResult, $actualResult);
    }
}
