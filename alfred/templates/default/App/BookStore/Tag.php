<?php

return AggregateRoot('Tag')
    ->with('name', Attribute('VO(TagName)')
        ->example('tagName')
    );

