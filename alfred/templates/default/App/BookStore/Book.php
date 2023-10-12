<?php


return AggregateRoot('Book')
    ->with('title', Attribute('VO(Title)')
        ->example('the title')
    )
    ->with('price', Attribute('VO(Price)')
        ->example(1400)

    )
    ->with('author', ManyToOne('Entity(Author)')
//        ->fetch(Fetch::EAGER)
//        ->cascade(Cascade::DETACH, Cascade::MERGE)
//        ->mappedBy('id')
//        ->cache('region', CacheUsage::NONSTRICT_READ_WRITE)
//        ->orphanRemoval(true)
    );
