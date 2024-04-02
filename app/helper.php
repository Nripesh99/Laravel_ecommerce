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
function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
    function countProducts($category)
    {
        
        $count = $category->product()->count();
        foreach ($category->descendants() as $child) {
            $count += countProducts($child);
        }
    
        return $count;
    }