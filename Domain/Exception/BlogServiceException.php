<?php

namespace App\Domain\Exception;

use Exception;

class BlogServiceException extends Exception
{
    public const BLOG_NOT_FOUND = "Blog not found.";
    public const BLOGS_NOT_FOUND = "Blogs not found.";
}
