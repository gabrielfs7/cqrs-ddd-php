<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Video\Module\Video\Domain\Video;

final class VideoResponseConverter
{
    public function __invoke(Video $video): VideoResponse
    {
        return new VideoResponse(
            $video->id()->value(),
            $video->type()->value(),
            $video->title()->value(),
            $video->url()->value(),
            $video->courseId()->value()
        );
    }
}
