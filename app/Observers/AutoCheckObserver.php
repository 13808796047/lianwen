<?php

namespace App\Observers;

use App\Jobs\TranslateEN;
use App\Models\AutoCheck;

class AutoCheckObserver
{
    public function created(AutoCheck $autoCheck)
    {
        dd($autoCheck);
        if(!$autoCheck->content_after) {
            dispatch(new TranslateEN($autoCheck));
        }
    }
}
