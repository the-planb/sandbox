<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

enum Classification: string
{
    case G = 'General Audiences';

    case PG = 'Parental Guidance Suggested';

    case PG_13 = 'Parents Strongly Cautioned';

    case R = 'Restricted';

    case NC_17 = 'Adults Only';
}
