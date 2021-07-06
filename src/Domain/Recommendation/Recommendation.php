<?php

namespace Studies\Architecture\Domain\Recommendation;

use Studies\Architecture\Domain\Student\Student;

class Recommendation
{
    private Student $recommender;
    private Student $recommended;
    private \DateTimeImmutable $data;

    public function __construct(string $recommender, string $recommended)
    {
        $this->recommender = $recommender;
        $this->recommended = $recommended;

        $this->data = new \DateTimeImmutable();
    }
}