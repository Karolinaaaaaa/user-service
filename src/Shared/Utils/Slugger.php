<?php

namespace App\Shared\Utils;

class Slugger
{
  public static function slugify(string $string): string
  {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
  }
}
