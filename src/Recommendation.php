<?php

namespace Studies\Architecture;

class Recommendation
{
    private Student $recommender;
    private Student $recommended;

    public function __construct(string $recommender, string $recommended)
    {
        $this->recommender = $recommender;
        $this->recommended = $recommended;
    }
}