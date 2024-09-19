<?php

return Service()
    ->onlyDomainService()
    ->input(Attribute('raw', 'VO(Score)'))
    ->output(Attribute('rating', 'VO(Score)'))
    ;
