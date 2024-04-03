<?php
use Illuminate\Support\Str;
function showTags()
{
    $tags = array(
        "1" => "php",
        "2" => "C#",
        "3" => "C++",
        "4" => "python",
        "5" => "VB",
        "6" => "Java",
        "7" => "JavaScript",
    );
   return $tags;    
}
function str_limit($value, $limit = 30, $end = '...')
    {
        
        return Str::limit($value, $limit, $end);
    }
    // function countProducts($category)
    // {
    //     // dd($category->toArray());
    //     $count = 0;
    //     foreach ($category->descendants() as $child) {
            
    //         $dataCount = $child->subcategory->toArray();
    //         dd($dataCoun)
    //         foreach($dataCount as $key => $value) {
                
    //             $count++;
    //         }
    //         // $count += countProducts($child);
    //     }
    //     dd($count);
    
    //     // return $count;
    // }
    function generateSlug($value)
{
    return Str::slug($value);
}