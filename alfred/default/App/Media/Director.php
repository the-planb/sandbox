<?php

return AggregateRoot()
    ->with(Attribute('name', 'VO(FullName)'))
    ->with(Aggregation('movies', 'Entity(Movie)'));

