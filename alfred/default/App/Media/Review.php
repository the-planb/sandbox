<?php

return Entity()
    ->with(Attribute('review', 'VO(ReviewContent)'))
    ->with(Attribute('score', 'VO(Score)'))
    ->with(ManyToOne('movie', 'Entity(Movie)')
        ->inversedBy('reviews'));
