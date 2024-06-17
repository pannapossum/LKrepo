<?php

namespace App\Services\Templates;

use App\Services\Service;

use DB;
use Config;

use App\Models\TemplateTag;

class PureService extends Service {
  public function getTemplate($tag) {
    return $tag->data['pure_html'];
  }

  public function parseData($data) {
    $data['data'] = ['pure_html' => $data['pure_html']];
    unset($data['pure_html']);
    return $data;
  }
}
