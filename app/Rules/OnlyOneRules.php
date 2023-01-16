<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OnlyOneRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $data="";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $table=$value['tables'];
        $find=$value['find'];

        $this->data=$value['data'];

        if($value['data']=="" or empty($value['data']))
        {
            return true;
        }

        $data = DB::table($table)->where($find,'!=',$value['data'])->where($attribute,$value[$attribute])->first();
        
        if(!$data){
            return true;
        }
        
        return false ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('messages.duplicate');
    }
}
