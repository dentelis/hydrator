<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DetailsPage2
{
    use DTOFactoryTrait;

    public string $title;
    public TextContent|ImageContent|TitleContent $content;

    //для удобства написания тестов
    function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    //для удобства написания тестов
    function setContent(TextContent|ImageContent|TitleContent $content): self
    {
        $this->content = $content;
        return $this;
    }
}
