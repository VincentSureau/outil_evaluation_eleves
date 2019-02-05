<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Entity\Student;
use App\Entity\Review;

class StudentListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        {
            $student = $args->getObject();
    
            if (!$student instanceof Student) {
                return;
            }

            $review = new Review();
            $student->setReview($review);
    
            $entityManager = $args->getObjectManager();
            $entityManager->persist($review);
            $entityManager->flush();
        }
    }
}