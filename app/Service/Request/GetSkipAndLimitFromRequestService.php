<?php

declare(strict_types=1);


namespace App\Service\Request;

use Illuminate\Http\Request;

final class GetSkipAndLimitFromRequestService
{

    public static function execute(Request $request): array
    {
        $skip = 0;
        $take = 10;

        if($request->has('skip')){
            $skip = $request->get('skip');
        }

        if($request->has('take')){

            $take = $request->get('take');

            if($take > 100){
                $take = 100;
            }
        }

        return [
            'skip' => $skip,
            'take' => $take
        ];
    }

}
